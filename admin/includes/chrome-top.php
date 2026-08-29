<?php
/** Expects $pageTitle and $activeAdminNav ('dashboard'|'categories'|'products'|'posts'|'certificates'|'messages'|'settings'). */
$activeAdminNav = $activeAdminNav ?? '';
$navClass = fn(string $key) => $activeAdminNav === $key ? 'is-active' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= h($pageTitle ?? 'Admin') ?> · HANIU Admin</title>
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-bar">
  <div class="admin-bar__brand">HANIU <span>ADMIN</span></div>
  <nav class="admin-nav">
    <a class="<?= $navClass('dashboard') ?>" href="index.php">Dashboard</a>
    <a class="<?= $navClass('products') ?>" href="products.php">Products</a>
    <a class="<?= $navClass('posts') ?>" href="posts.php">Blog Posts</a>
    <a class="<?= $navClass('certificates') ?>" href="certificates.php">Certificates</a>
    <a class="<?= $navClass('messages') ?>" href="messages.php">Messages</a>
    <a class="<?= $navClass('settings') ?>" href="settings.php">Settings</a>
  </nav>
  <div class="admin-bar__user">
    <a href="../index.php" target="_blank" rel="noopener">View site &#8599;</a>
    <span>·</span>
    <a href="logout.php">Log out</a>
  </div>
</div>

<div class="admin-wrap">
