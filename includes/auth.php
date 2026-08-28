<?php
/** Admin-session helpers. Requires config.php to already be loaded. */

function current_admin(): ?array
{
    if (empty($_SESSION['admin_id'])) {
        return null;
    }
    return db_one('SELECT id, username FROM admins WHERE id = ?', [$_SESSION['admin_id']]);
}

/** Call at the top of every admin page except login.php. */
function require_admin(): array
{
    $admin = current_admin();
    if (!$admin) {
        header('Location: login.php');
        exit;
    }
    return $admin;
}

function attempt_login(string $username, string $password): bool
{
    $admin = db_one('SELECT id, password_hash FROM admins WHERE username = ?', [$username]);
    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        return true;
    }
    return false;
}

function logout(): void
{
    $_SESSION = [];
    session_destroy();
}
