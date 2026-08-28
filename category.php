<?php
require __DIR__ . '/config.php';

$slug = trim((string) ($_GET['slug'] ?? ''));
$cat = $slug !== '' ? db_one('SELECT * FROM categories WHERE slug = ?', [$slug]) : null;

if (!$cat) {
    http_response_code(404);
    $pageTitle = 'Category Not Found | HANIU Electric Tricycles & Ebicycles Factory in China';
    require __DIR__ . '/includes/header.php';
    ?>
    <section class="section">
      <div class="container" style="text-align:center;padding:60px 0">
        <h1 class="h2">Category Not Found</h1>
        <p class="lead">This category doesn't exist or may have been removed.</p>
        <a class="btn btn--red" href="index.php">Back to Home</a>
      </div>
    </section>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $cat['name'] . ' | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'HANIU ' . $cat['name'] . ' for distributors and OEM buyers, factory direct from our Tianjin manufacturing base.';
require __DIR__ . '/includes/header.php';

$categorySlugs = $cat['slug'];
$categoryPill = $cat['pill'] !== '' ? $cat['pill'] : strtoupper($cat['name']);
$categoryTitle = $cat['name'];
$categoryLead = h($cat['lead']);
require __DIR__ . '/includes/category-template.php';

require __DIR__ . '/includes/footer.php';
