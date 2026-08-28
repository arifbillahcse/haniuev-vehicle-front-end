<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/auth.php';
$admin = require_admin();

$counts = [
    'categories' => db_one('SELECT COUNT(*) AS n FROM categories')['n'],
    'products' => db_one('SELECT COUNT(*) AS n FROM products')['n'],
    'posts'    => db_one('SELECT COUNT(*) AS n FROM posts')['n'],
    'messages' => db_one('SELECT COUNT(*) AS n FROM messages')['n'],
    'unread'   => db_one('SELECT COUNT(*) AS n FROM messages WHERE is_read = 0')['n'],
];

$flash = '';
$flashType = 'ok';
$pwError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current = (string) ($_POST['current_password'] ?? '');
    $new = (string) ($_POST['new_password'] ?? '');
    $confirm = (string) ($_POST['confirm_password'] ?? '');

    $row = db_one('SELECT password_hash FROM admins WHERE id = ?', [$admin['id']]);
    if (!password_verify($current, $row['password_hash'])) {
        $pwError = 'Current password is incorrect.';
    } elseif (strlen($new) < 8) {
        $pwError = 'New password must be at least 8 characters.';
    } elseif ($new !== $confirm) {
        $pwError = 'New password and confirmation do not match.';
    } else {
        db_run('UPDATE admins SET password_hash = ? WHERE id = ?', [password_hash($new, PASSWORD_BCRYPT), $admin['id']]);
        $flash = 'Password updated successfully.';
    }
}

$pageTitle = 'Dashboard';
$activeAdminNav = 'dashboard';
require __DIR__ . '/includes/chrome-top.php';
?>

<div class="admin-head">
  <div>
    <h1>Welcome back, <?= h($admin['username']) ?></h1>
    <p>Here's what's happening across the site.</p>
  </div>
</div>

<div class="stat-grid">
  <div class="stat"><b><?= (int) $counts['categories'] ?></b><span>Categories</span></div>
  <div class="stat"><b><?= (int) $counts['products'] ?></b><span>Products</span></div>
  <div class="stat"><b><?= (int) $counts['posts'] ?></b><span>Blog Posts</span></div>
  <div class="stat"><b><?= (int) $counts['messages'] ?></b><span>Total Messages</span></div>
  <div class="stat"><b style="color:<?= $counts['unread'] > 0 ? 'var(--red)' : 'var(--ink)' ?>"><?= (int) $counts['unread'] ?></b><span>Unread Messages</span></div>
</div>

<div class="card">
  <h2 style="font-size:16px">Quick Links</h2>
  <p style="margin:0 0 14px;color:var(--muted);font-size:13.5px">Add new content or review recent inquiries.</p>
  <a class="btn btn--red btn--sm" href="categories.php?action=new">+ Add Category</a>
  <a class="btn btn--ghost btn--sm" href="products.php?action=new">+ Add Product</a>
  <a class="btn btn--ghost btn--sm" href="posts.php?action=new">+ Add Blog Post</a>
  <a class="btn btn--ghost btn--sm" href="messages.php">View Messages</a>
</div>

<div class="card" style="max-width:440px">
  <h2 style="font-size:16px">Change Password</h2>
  <?php if ($flash): ?><div class="flash flash--ok"><?= h($flash) ?></div><?php endif; ?>
  <?php if ($pwError): ?><div class="flash flash--err"><?= h($pwError) ?></div><?php endif; ?>
  <form method="post">
    <input type="hidden" name="change_password" value="1">
    <div class="field">
      <label for="current_password">Current Password</label>
      <input type="password" id="current_password" name="current_password" required>
    </div>
    <div class="field">
      <label for="new_password">New Password</label>
      <input type="password" id="new_password" name="new_password" required minlength="8">
      <small>At least 8 characters.</small>
    </div>
    <div class="field">
      <label for="confirm_password">Confirm New Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
    </div>
    <button type="submit" class="btn btn--red">Update Password</button>
  </form>
</div>

<?php require __DIR__ . '/includes/chrome-bottom.php'; ?>
