<?php
/**
 * Bootstrap: session, error display, PDO connection, tiny DB helpers.
 * SQLite lives in data/haniu.sqlite — a single file, no DB server needed.
 * data/.htaccess denies all HTTP access to it; never move it into a public path.
 *
 * To move to MySQL later (if your host requires it): change DB_DSN below to
 * "mysql:host=localhost;dbname=haniu;charset=utf8mb4" with matching
 * DB_USER/DB_PASS, then re-run schema.sql against that database. Every query
 * in this project uses plain, portable SQL and PDO placeholders, so nothing
 * else needs to change.
 */

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '0'); // flip to '1' while developing locally

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_PATH', __DIR__);
define('DB_PATH', BASE_PATH . '/data/haniu.sqlite');
define('DB_DSN', 'sqlite:' . DB_PATH);

function db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $isNew = !file_exists(DB_PATH);
    if ($isNew && !is_dir(dirname(DB_PATH))) {
        mkdir(dirname(DB_PATH), 0755, true);
    }

    $pdo = new PDO(DB_DSN, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec('PRAGMA foreign_keys = ON');

    if ($isNew) {
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
