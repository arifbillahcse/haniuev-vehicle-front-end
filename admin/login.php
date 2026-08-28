<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';

if (current_admin()) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    if (attempt_login($username, $password)) {
        header('Location: index.php');
        exit;
    }
    $error = 'Incorrect username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login · HANIU</title>
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="login-shell">
  <div class="login-card">
    <h1>HANIU Admin</h1>
    <p>Sign in to manage products, blog posts, and inquiries.</p>

    <?php if ($error): ?>
      <div class="flash flash--err"><?= h($error) ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus value="<?= h($_POST['username'] ?? '') ?>">
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn--red" style="width:100%;justify-content:center">Sign In</button>
    </form>
  </div>
</div>
</body>
</html>
