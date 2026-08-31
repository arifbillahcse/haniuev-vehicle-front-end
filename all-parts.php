<?php
require __DIR__ . '/config.php';

$pageTitle = 'Spare Parts | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'Browse every spare part HANIU manufactures, organized by category.';
require __DIR__ . '/includes/header.php';

// Every category except the 4 vehicle types — so a new category added from
// admin/categories.php shows up here automatically, with no code change.
$placeholders = implode(',', array_fill(0, count(VEHICLE_CATEGORY_SLUGS), '?'));
$partCategories = db_all("SELECT * FROM categories WHERE slug NOT IN ($placeholders) ORDER BY sort_order", VEHICLE_CATEGORY_SLUGS);

// Only build a section for categories that actually have products yet, so
// a freshly added category with nothing in it doesn't clutter the page.
$sections = [];
foreach ($partCategories as $cat) {
    $products = db_all('SELECT * FROM products WHERE category = ? ORDER BY sort_order, id LIMIT 3', [$cat['slug']]);
    if ($products) {
        $sections[] = ['category' => $cat, 'products' => $products];
    }
}
?>

<section class="page-hero">
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i>SPARE PARTS</span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80">Spare Parts</span>
    </h1>
    <p class="page-hero__lead" data-reveal data-reveal-delay="160">
      Every spare part HANIU manufactures in-house, organized by category -- available for
      wholesale, distribution, and OEM/ODM branding.
    </p>
  </div>
</section>

<?php if ($sections): ?>
  <?php foreach ($sections as $i => $section): ?>
    <section class="section<?= $i % 2 === 1 ? ' section--alt' : '' ?>">
      <div class="container">
        <header class="sec-head sec-head--row">
          <div>
            <p class="eyebrow" data-reveal><span class="eyebrow__rule"></span><?= h($section['category']['pill'] !== '' ? $section['category']['pill'] : strtoupper($section['category']['name'])) ?></p>
            <h2 class="h2" data-reveal data-reveal-delay="80"><?= h($section['category']['name']) ?></h2>
          </div>
          <a class="link-dark" href="category.php?slug=<?= urlencode($section['category']['slug']) ?>" data-reveal data-reveal-delay="120">View All <svg><use href="#i-arrow-right"/></svg></a>
        </header>

        <div class="prod-grid">
          <?php foreach ($section['products'] as $j => $product): ?>
            <?php $delay = $j * 80; require __DIR__ . '/includes/product-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endforeach; ?>
<?php else: ?>
  <section class="section">
    <div class="container" style="text-align:center;padding:20px 0 60px">
      <p class="lead">No spare parts have been added yet — check back soon.</p>
    </div>
  </section>
<?php endif; ?>

<?php
$ctaHref = 'contact.php#contact-form';
require __DIR__ . '/includes/footer.php';
