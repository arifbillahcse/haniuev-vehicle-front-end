<?php
require __DIR__ . '/config.php';

$posts = db_all('SELECT * FROM posts ORDER BY published_at DESC, id DESC');

$pageTitle = 'Blog | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'News, certifications, and export guidance from HANIU — China\'s premier B2B electric vehicle manufacturer.';
$activeNav = 'blog';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i>NEWS &amp; UPDATES</span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80">From the HANIU Blog</span>
    </h1>
    <p class="page-hero__lead" data-reveal data-reveal-delay="160">
      Certifications, factory updates, and export guidance for our distributors and partners.
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="prod-grid">
      <?php foreach ($posts as $i => $post): ?>
        <?php $delay = ($i % 3) * 80; require __DIR__ . '/includes/post-card.php'; ?>
      <?php endforeach; ?>
      <?php if (!$posts): ?>
        <p class="lead">No posts yet — check back soon.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
$ctaHref = 'contact.php#contact-form';
require __DIR__ . '/includes/footer.php';
