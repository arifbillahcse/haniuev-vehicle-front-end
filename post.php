<?php
require __DIR__ . '/config.php';

$post = db_one('SELECT * FROM posts WHERE slug = ?', [(string) ($_GET['slug'] ?? '')]);

if (!$post) {
    http_response_code(404);
}

$pageTitle = $post
    ? $post['title'] . ' | HANIU Blog'
    : 'Post Not Found | HANIU Blog';
$pageDescription = $post ? $post['excerpt'] : 'This article could not be found.';
$activeNav = 'blog';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i>NEWS &amp; UPDATES</span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80"><?= h($post['title'] ?? 'Post Not Found') ?></span>
    </h1>
    <?php if ($post): ?>
      <p class="page-hero__lead" data-reveal data-reveal-delay="160"><?= h($post['excerpt']) ?></p>
    <?php endif; ?>
  </div>
</section>

<section class="section">
  <div class="container prose">
    <?php if ($post): ?>
      <p class="prose__meta"><svg style="width:15px;height:15px"><use href="#i-clock"/></svg> <?= h(date('F j, Y', strtotime($post['published_at']))) ?></p>
      <?php foreach (preg_split('/\R/', trim($post['body'])) as $paragraph): ?>
        <?php if (trim($paragraph) === '') continue; ?>
        <p><?= h($paragraph) ?></p>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Sorry, we couldn't find that article. It may have been moved or removed.</p>
    <?php endif; ?>
    <hr class="rule">
    <a class="link-dark" href="blog.php">&larr; Back to Blog</a>
  </div>
</section>

<?php
$ctaHref = 'contact.php#contact-form';
require __DIR__ . '/includes/footer.php';
