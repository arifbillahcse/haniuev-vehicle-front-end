<?php
require __DIR__ . '/config.php';
require __DIR__ . '/includes/inquiry-handler.php';

$product = db_one('SELECT * FROM products WHERE slug = ?', [(string) ($_GET['slug'] ?? '')]);
$gallery = $product ? db_all('SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order, id', [$product['id']]) : [];
$specs = $product ? db_all('SELECT * FROM product_specs WHERE product_id = ? ORDER BY sort_order, id', [$product['id']]) : [];
$related = $product ? db_all(
    'SELECT * FROM products WHERE category = ? AND id != ? ORDER BY sort_order LIMIT 3',
    [$product['category'], $product['id']]
) : [];

$pageTitle = $product
    ? $product['name'] . ' | HANIU Electric Tricycles & Ebicycles Factory in China'
    : 'Product Not Found | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = $product ? $product['spec'] : 'This product could not be found.';
$extraCss = ['contact.css', 'product.css'];
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i><?= h($product['cat_label'] ?? 'NOT FOUND') ?></span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80"><?= h($product['name'] ?? 'Product Not Found') ?></span>
    </h1>
    <?php if ($product): ?>
      <p class="page-hero__lead" data-reveal data-reveal-delay="160"><?= h($product['spec']) ?></p>
    <?php endif; ?>
  </div>
</section>

<?php if (!$product): ?>
  <section class="section">
    <div class="container" style="text-align:center;padding:20px 0 60px">
      <p class="lead">Sorry, we couldn't find that product. It may have been moved or removed.</p>
      <a class="btn btn--red" href="index.php#portfolio">Browse Products</a>
    </div>
  </section>
<?php else: ?>

  <?php
  $allImages = array_values(array_unique(array_filter(array_merge(
      [$product['image']],
      array_column($gallery, 'image')
  ), fn($img) => $img !== '')));
  if (!$allImages) $allImages = [''];
  ?>

  <section class="section">
    <div class="container product-detail">

      <div class="product-gallery" data-reveal>
        <div class="product-gallery__main media" data-label="600 × 400">
          <img src="<?= $allImages[0] !== '' ? h('assets/images/' . $allImages[0]) : '' ?>" alt="<?= h($product['name']) ?>" id="productMainImg">
        </div>
        <?php if (count($allImages) > 1): ?>
          <div class="product-gallery__thumbs">
            <?php foreach ($allImages as $i => $img): ?>
              <button type="button" class="product-gallery__thumb<?= $i === 0 ? ' is-active' : '' ?>" data-img="assets/images/<?= h($img) ?>">
                <img src="assets/images/<?= h($img) ?>" alt="">
              </button>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="product-info" data-reveal data-reveal-delay="120">
        <p class="prod__cat"><?= h($product['cat_label']) ?></p>
        <?php if ($product['badge_text'] !== ''): ?>
          <span class="tag tag--<?= h($product['badge_color']) ?>"><?= h($product['badge_text']) ?></span>
        <?php endif; ?>
        <h2 class="product-info__name"><?= h($product['name']) ?></h2>
        <p class="product-info__spec"><?= h($product['spec']) ?></p>

        <?php if (trim((string) $product['description']) !== ''): ?>
          <div class="prose product-info__desc">
            <?php foreach (preg_split('/\R/', trim((string) $product['description'])) as $para): ?>
              <?php if (trim($para) === '') continue; ?>
              <p><?= h($para) ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if ($specs): ?>
          <table class="spec-table">
            <?php foreach ($specs as $s): ?>
              <tr><th><?= h($s['label']) ?></th><td><?= h($s['value']) ?></td></tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>

        <?php if ($product['catalog_pdf'] !== ''): ?>
          <div class="product-info__actions">
            <a class="btn btn--red" href="assets/catalogs/<?= h($product['catalog_pdf']) ?>" target="_blank" rel="noopener">
              Catalog PDF Download <svg><use href="#i-arrow-right"/></svg>
            </a>
          </div>
        <?php endif; ?>

        <hr class="rule">

        <div class="contact-form-card" style="border:none;padding:0;box-shadow:none">
          <h3 class="contact-form-card__title">Request Wholesale Pricing</h3>
          <p class="contact-form-card__sub">Fill in the form and our export team will get back to you promptly.</p>
          <form id="inquiryForm" method="post">
            <?php require __DIR__ . '/includes/inquiry-fields.php'; ?>
          </form>
        </div>
      </div>

    </div>
  </section>

  <?php if ($related): ?>
    <section class="section section--alt product-related">
      <div class="container">
        <header class="sec-head">
          <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>YOU MIGHT ALSO LIKE<span class="eyebrow__rule"></span></p>
          <h2 class="h2" data-reveal data-reveal-delay="80">Related Products</h2>
        </header>
        <div class="prod-grid">
          <?php foreach ($related as $i => $rp): ?>
            <?php $product = $rp; $delay = $i * 80; require __DIR__ . '/includes/product-card.php'; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

<?php endif; ?>

<?php
$ctaHref = 'contact.php#contact-form';
require __DIR__ . '/includes/footer.php';
