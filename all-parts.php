<?php
require __DIR__ . '/config.php';

$pageTitle = 'All Parts | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'Browse every spare part HANIU manufactures across every parts category.';
require __DIR__ . '/includes/header.php';

// Every category except the 4 vehicle types — so a new category added from
// admin/categories.php shows up here automatically, with no code change.
$vehicleCategories = ['bicycle', 'motorcycle', 'tricycle', 'four-wheeler'];
$placeholders = implode(',', array_fill(0, count($vehicleCategories), '?'));
$categorySlugs = array_column(
    db_all("SELECT slug FROM categories WHERE slug NOT IN ($placeholders) ORDER BY sort_order", $vehicleCategories),
    'slug'
);
if (!$categorySlugs) {
    $categorySlugs = ['__none__']; // no matching category — shows the empty state below
}

$categoryPill = 'SPARE PARTS';
$categoryTitle = 'All Parts';
$categoryLead = 'Every spare part HANIU manufactures in-house -- available for wholesale, distribution, and OEM/ODM branding.';
require __DIR__ . '/includes/category-template.php';

require __DIR__ . '/includes/footer.php';
