<?php
/**
 * Shared "single category" page body: compact hero + a .prod-grid of every
 * product in the given category (or categories). Used by
 * electric-bicycles.php and motors-controllers.php so a new category page
 * is just a 15-line wrapper — see either of those files for the pattern.
 *
 * Expects: $categoryPill, $categoryTitle, $categoryLead (hero copy) and
 * $categorySlugs (string or array of product.category values to show).
 */
$slugs = (array) $categorySlugs;
$placeholders = implode(',', array_fill(0, count($slugs), '?'));
$categoryProducts = db_all(
    "SELECT * FROM products WHERE category IN ($placeholders) ORDER BY sort_order, id",
    $slugs
);
?>
<section class="page-hero">
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i><?= h($categoryPill) ?></span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80"><?= h($categoryTitle) ?></span>
    </h1>
    <p class="page-hero__lead" data-reveal data-reveal-delay="160">
      <?= $categoryLead /* pre-escaped in the caller so it can carry -- and similar */ ?>
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="prod-grid">
      <?php foreach ($categoryProducts as $i => $product): ?>
        <?php $delay = ($i % 3) * 80; require __DIR__ . '/product-card.php'; ?>
      <?php endforeach; ?>
      <?php if (!$categoryProducts): ?>
        <p class="lead">No products in this category yet — check back soon.</p>
      <?php endif; ?>
    </div>
  </div>
</section>
