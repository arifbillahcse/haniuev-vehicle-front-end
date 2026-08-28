<?php
require __DIR__ . '/config.php';

$pageTitle = 'Motors & Controllers | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'HANIU motors and controllers for distributors and OEM buyers — hub motors, mid-drive motors, and programmable controllers, produced in-house at our Wuxi powertrain base.';
require __DIR__ . '/includes/header.php';

$categorySlugs = ['motor', 'controller'];
$categoryPill = 'POWERTRAIN';
$categoryTitle = 'Motors & Controllers';
$categoryLead = 'Hub motors, mid-drive motors, and programmable controllers engineered and tested in-house
      at our Wuxi powertrain base -- available for wholesale, distribution, and OEM/ODM branding.';
require __DIR__ . '/includes/category-template.php';

require __DIR__ . '/includes/footer.php';
