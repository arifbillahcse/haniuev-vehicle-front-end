<?php
/**
 * Renders one .prod card. Expects $product (a row from the products table)
 * and optional $delay (data-reveal-delay in ms, default 0).
 */
$delay = $delay ?? 0;
$img = $product['image'] !== '' ? 'assets/images/' . $product['image'] : '';
?>
<article class="prod" data-reveal data-reveal-delay="<?= (int) $delay ?>">
  <div class="prod__media media media--3x2 media--zoom" data-label="600 × 400">
    <img src="<?= h($img) ?>" alt="<?= h($product['name']) ?>">
    <?php if ($product['badge_text'] !== ''): ?>
      <span class="tag tag--<?= h($product['badge_color']) ?> prod__tag"><?= h($product['badge_text']) ?></span>
    <?php endif; ?>
  </div>
  <div class="prod__body">
    <p class="prod__cat"><?= h($product['cat_label']) ?></p>
    <h3 class="prod__name"><?= h($product['name']) ?></h3>
    <p class="prod__spec"><?= h($product['spec']) ?></p>
    <div class="prod__foot">
      <a class="prod__cta" href="contact.php#contact-form">Get Wholesale Price <svg><use href="#i-arrow-right"/></svg></a>
      <span class="prod__moq">MOQ AVAILABLE</span>
    </div>
  </div>
</article>
