<?php
require __DIR__ . '/config.php';

$pageTitle = 'All Parts | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'Browse every spare part HANIU manufactures — motors, controllers, batteries & chargers, frames & body parts, and wiring harnesses.';
require __DIR__ . '/includes/header.php';

$categorySlugs = ['motor', 'controller', 'battery', 'frame', 'wiring'];
$categoryPill = 'SPARE PARTS';
$categoryTitle = 'All Parts';
$categoryLead = 'Every spare part HANIU manufactures in-house -- motors, controllers, batteries &amp; chargers,
      frames &amp; body parts, and wiring harnesses -- available for wholesale, distribution, and OEM/ODM branding.';
require __DIR__ . '/includes/category-template.php';

require __DIR__ . '/includes/footer.php';
