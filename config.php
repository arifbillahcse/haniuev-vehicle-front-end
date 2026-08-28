<?php
/**
 * Bootstrap: session, error display, PDO connection, tiny DB helpers.
 * Connects to MySQL using credentials from db-config.php (gitignored — copy
 * db-config.sample.php to create it and fill in your host's real values).
 * Tables are created automatically from schema.sql the first time any page
 * runs against an empty database; the database itself must already exist.
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

    try {
        $pdo->query('SELECT 1 FROM admins LIMIT 1');
    } catch (PDOException $e) {
        // Fresh database — no tables yet. Create them from schema.sql.
        $pdo->exec(file_get_contents(BASE_PATH . '/schema.sql'));
    }

    return $pdo;
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
