<?php
/**
 * Copy this file to db-config.php (same folder) and fill in the real values
 * for your MySQL database. db-config.php is gitignored — it never gets
 * committed, so your credentials stay off GitHub.
 *
 * Most hosts (cPanel etc.) give you these when you create a MySQL database:
 * a host (almost always "localhost"), a database name, a username, and a
 * password. The database itself must already exist — this app creates the
 * tables inside it automatically on first request, but it can't create the
 * database.
 */

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'haniu_ev');
define('DB_USER', 'your_db_username');
define('DB_PASS', 'your_db_password');
