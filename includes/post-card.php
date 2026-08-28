<?php
/**
 * Renders one blog post card. Reuses the .prod card component (same CSS as
 * product cards — nothing about that markup is actually product-specific)
 * with different content. Expects $post and optional $delay.
 */
$delay = $delay ?? 0;
$img = $post['cover_image'] !== '' ? 'assets/images/' . $post['cover_image'] : '';
$dateLabel = strtoupper(date('M j, Y', strtotime($post['published_at'])));
?>
<article class="prod" data-reveal data-reveal-delay="<?= (int) $delay ?>">
  <div class="prod__media media media--3x2 media--zoom" data-label="1200 × 800">
    <img src="<?= h($img) ?>" alt="<?= h($post['title']) ?>">
  </div>
  <div class="prod__body">
    <p class="prod__cat"><?= h($dateLabel) ?></p>
    <h3 class="prod__name"><?= h($post['title']) ?></h3>
    <p class="prod__spec"><?= h($post['excerpt']) ?></p>
    <div class="prod__foot">
      <a class="prod__cta" href="post.php?slug=<?= urlencode($post['slug']) ?>">Read More <svg><use href="#i-arrow-right"/></svg></a>
    </div>
  </div>
</article>
