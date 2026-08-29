<?php
/**
 * Bootstrap: session, error display, PDO connection, tiny DB helpers.
 * Connects to MySQL using credentials from db-config.php (gitignored — copy
 * db-config.sample.php to create it and fill in your host's real values).
 *
 * Schema lives in database/sql-v1.sql, sql-v2.sql, ... — each file runs
 * exactly once, in order, tracked in the _migrations table. A schema change
 * is always a NEW sql-vN.sql file, never an edit to an already-shipped one,
 * so a live database only ever gets the new piece applied, not re-run from
 * scratch.
 */

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '0'); // flip to '1' while developing locally

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_PATH', __DIR__);

if (!file_exists(BASE_PATH . '/db-config.php')) {
    http_response_code(500);
    exit('Missing db-config.php. Copy db-config.sample.php to db-config.php and fill in your MySQL credentials.');
}
require BASE_PATH . '/db-config.php';

define('DB_DSN', 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4');

function db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $pdo = new PDO(DB_DSN, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    run_migrations($pdo);

    return $pdo;
}

/** Run any database/sql-vN.sql file not yet recorded in _migrations, in order. */
function run_migrations(PDO $pdo): void
{
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS _migrations (
            id         INT AUTO_INCREMENT PRIMARY KEY,
            filename   VARCHAR(190) NOT NULL UNIQUE,
            applied_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
    );

    $applied = array_column($pdo->query('SELECT filename FROM _migrations')->fetchAll(), 'filename');

    $files = glob(BASE_PATH . '/database/sql-v*.sql') ?: [];
    natsort($files); // so sql-v2 runs before sql-v10, not after

    foreach ($files as $file) {
        $filename = basename($file);
        if (in_array($filename, $applied, true)) {
            continue;
        }
        $pdo->exec(file_get_contents($file));
        $pdo->prepare('INSERT INTO _migrations (filename) VALUES (?)')->execute([$filename]);
    }
}

/** SELECT many rows. */
function db_all(string $sql, array $params = []): array
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/** SELECT one row, or null. */
function db_one(string $sql, array $params = []): ?array
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

/** INSERT/UPDATE/DELETE. Returns affected row count. */
function db_run(string $sql, array $params = []): int
{
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
}

/** All site settings as [key => value], e.g. social media links. Cached per-request. */
function settings(): array
{
    static $cache = null;
    if ($cache === null) {
        $cache = array_column(db_all('SELECT setting_key, setting_value FROM settings'), 'setting_value', 'setting_key');
    }
    return $cache;
}

/** One setting's value, or '' if not set. */
function setting(string $key): string
{
    return settings()[$key] ?? '';
}

/**
 * Move an uploaded file (one entry from $_FILES) into $destDir with a
 * randomly generated filename — the original filename is never trusted or
 * reused. Returns the new filename, or null if no file was sent, the
 * extension isn't in $allowedExt, or (when $isImage) the content doesn't
 * actually decode as an image. Used for product images, gallery photos, and
 * catalog PDFs uploaded from the admin.
 */
function save_uploaded_file(array $file, string $destDir, array $allowedExt, bool $isImage): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return null;
    }

    $ext = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        return null;
    }

    if ($isImage) {
        if (@getimagesize($file['tmp_name']) === false) {
            return null;
        }
    } elseif (substr((string) file_get_contents($file['tmp_name'], false, null, 0, 4), 0, 4) !== '%PDF') {
        return null;
    }

    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    $filename = bin2hex(random_bytes(8)) . '.' . $ext;
    return move_uploaded_file($file['tmp_name'], $destDir . '/' . $filename) ? $filename : null;
}

/** Escape for safe HTML output. */
function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** URL-safe slug from a title (e.g. "HN-B200 Urban" -> "hn-b200-urban"). */
function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-') ?: 'item';
}

/**
 * Slugify $base and make it unique within $table (appending -2, -3, ... on
 * collision). $table is admin-controlled (never user input) — always call
 * this with a literal table name.
 */
function unique_slug(string $base, string $table, ?int $excludeId = null): string
{
    $slug = slugify($base);
    $original = $slug;
    $i = 2;
    while (true) {
        $sql = "SELECT id FROM {$table} WHERE slug = ?";
        $params = [$slug];
        if ($excludeId !== null) {
            $sql .= ' AND id != ?';
            $params[] = $excludeId;
        }
        if (!db_one($sql, $params)) {
            return $slug;
        }
        $slug = $original . '-' . $i++;
    }
}
