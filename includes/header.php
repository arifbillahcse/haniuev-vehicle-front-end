<?php
/**
 * Shared <head> + header/nav, identical across every page.
 * Expects (all optional except pageTitle): $pageTitle, $pageDescription,
 * $extraCss (array of paths under assets/css/), $activeNav (one of
 * 'home','about','contact','bicycles','motors','blog').
 */
$activeNav = $activeNav ?? '';
$extraCss = $extraCss ?? [];
$isActive = fn(string $key) => $activeNav === $key ? ' is-active' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= h($pageTitle ?? 'HANIU Electric Tricycles & Ebicycles Factory in China') ?></title>
<meta name="description" content="<?= h($pageDescription ?? "HANIU is China's premier B2B manufacturer of electric tricycles, e-bicycles, e-motorcycles and four-wheelers.") ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<?php foreach ($extraCss as $css): ?>
<link rel="stylesheet" href="assets/css/<?= h($css) ?>">
<?php endforeach; ?>
</head>
<body>

<svg class="svg-sprite" aria-hidden="true" focusable="false">
  <defs>
    <symbol id="i-building" viewBox="0 0 24 24"><path d="M3 21h18M5 21V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v16M15 21V9h4a2 2 0 0 1 2 2v10M9 7h2M9 11h2M9 15h2"/></symbol>
    <symbol id="i-globe" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.7 3.8 5.8 3.8 9S14.5 18.3 12 21c-2.5-2.7-3.8-5.8-3.8-9S9.5 5.7 12 3z"/></symbol>
    <symbol id="i-check-badge" viewBox="0 0 24 24"><path d="M12 2.5l2.3 1.7 2.8-.3 1 2.7 2.4 1.5-.8 2.7.8 2.7-2.4 1.5-1 2.7-2.8-.3L12 21.5l-2.3-1.7-2.8.3-1-2.7L3.5 16l.8-2.7-.8-2.7 2.4-1.5 1-2.7 2.8.3z"/><path d="M9 12.2l2.1 2.1L15.4 10"/></symbol>
    <symbol id="i-users" viewBox="0 0 24 24"><path d="M16 20v-1.6a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4V20"/><circle cx="9" cy="7.4" r="3.4"/><path d="M22 20v-1.6a4 4 0 0 0-3-3.9M16.2 4.2a4 4 0 0 1 0 6.4"/></symbol>
    <symbol id="i-pin" viewBox="0 0 24 24"><path d="M20 10.5c0 5.5-8 12-8 12s-8-6.5-8-12a8 8 0 1 1 16 0z"/><circle cx="12" cy="10.3" r="2.9"/></symbol>
    <symbol id="i-cart" viewBox="0 0 24 24"><circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M2 3h3l2.6 12.1a2 2 0 0 0 2 1.6h8.2a2 2 0 0 0 2-1.55L21.5 8H6"/></symbol>
    <symbol id="i-check-circle" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8.5 12.3l2.4 2.4 4.6-4.9"/></symbol>
    <symbol id="i-arrow-right" viewBox="0 0 24 24"><path d="M4 12h15M13 6l6 6-6 6"/></symbol>
    <symbol id="i-arrow-up" viewBox="0 0 24 24"><path d="M12 20V5M6 11l6-6 6 6"/></symbol>
    <symbol id="i-chevron-down" viewBox="0 0 24 24"><path d="M6 9.5l6 6 6-6"/></symbol>
    <symbol id="i-chevron-right" viewBox="0 0 24 24"><path d="M9.5 6l6 6-6 6"/></symbol>
    <symbol id="i-sliders" viewBox="0 0 24 24"><path d="M6 21V15M6 11V3M12 21v-9M12 8V3M18 21v-5M18 12V3M3 15h6M9 8h6M15 16h6"/></symbol>
    <symbol id="i-spray" viewBox="0 0 24 24"><path d="M9 21h7a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2zM10 7V4.5A1.5 1.5 0 0 1 11.5 3h2A1.5 1.5 0 0 1 15 4.5V7"/><path d="M20.5 4v.01M20.5 8v.01M20.5 12v.01"/></symbol>
    <symbol id="i-flask" viewBox="0 0 24 24"><path d="M9.5 3v6.2L4.4 18a2 2 0 0 0 1.7 3h11.8a2 2 0 0 0 1.7-3l-5.1-8.8V3"/><path d="M8 3h8M7 14.5h10"/></symbol>
    <symbol id="i-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3.2"/><path d="M19.4 14.5a1.7 1.7 0 0 0 .34 1.87l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.87-.34 1.7 1.7 0 0 0-1 1.56V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.55 1.7 1.7 0 0 0-1.87.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.7 1.7 0 0 0 .34-1.87 1.7 1.7 0 0 0-1.56-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.55-1.1 1.7 1.7 0 0 0-.34-1.87l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.7 1.7 0 0 0 1.87.34H9a1.7 1.7 0 0 0 1-1.56V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.56 1.7 1.7 0 0 0 1.87-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.7 1.7 0 0 0-.34 1.87V9a1.7 1.7 0 0 0 1.56 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1.1z"/></symbol>
    <symbol id="i-bolt" viewBox="0 0 24 24"><path d="M13.5 2L4 14h7l-.5 8L20 10h-7l.5-8z"/></symbol>
    <symbol id="i-grid" viewBox="0 0 24 24"><rect x="3" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="3" width="7.5" height="7.5" rx="1.5"/><rect x="3" y="13.5" width="7.5" height="7.5" rx="1.5"/><rect x="13.5" y="13.5" width="7.5" height="7.5" rx="1.5"/></symbol>
    <symbol id="i-lifebuoy" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3.6"/><path d="M5.6 5.6l3.85 3.85M14.55 14.55l3.85 3.85M18.4 5.6l-3.85 3.85M9.45 14.55L5.6 18.4"/></symbol>
    <symbol id="i-mail" viewBox="0 0 24 24"><rect x="2.5" y="5" width="19" height="14" rx="2"/><path d="M3 6.5l9 6.2 9-6.2"/></symbol>
    <symbol id="i-phone" viewBox="0 0 24 24"><path d="M21.5 16.9v2.6a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 1.6 3.7 2 2 0 0 1 3.6 1.5h2.6a2 2 0 0 1 2 1.7c.13.96.36 1.9.7 2.8a2 2 0 0 1-.45 2.1L7.3 9.3a16 16 0 0 0 6 6l1.2-1.15a2 2 0 0 1 2.1-.45c.9.34 1.84.57 2.8.7a2 2 0 0 1 1.7 2.05z"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5.2l3.3 2"/></symbol>
    <symbol id="i-menu" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></symbol>
    <symbol id="i-warehouse" viewBox="0 0 24 24"><path d="M3 21V9.2a1 1 0 0 1 .62-.93l8-3.2a1 1 0 0 1 .76 0l8 3.2a1 1 0 0 1 .62.93V21"/><path d="M2 21h20M7.5 21v-6.5h9V21M7.5 17.5h9"/></symbol>
    <symbol id="i-box" viewBox="0 0 24 24"><path d="M21 7.9v8.2a1.6 1.6 0 0 1-.85 1.42l-7.4 3.9a1.6 1.6 0 0 1-1.5 0l-7.4-3.9A1.6 1.6 0 0 1 3 16.1V7.9a1.6 1.6 0 0 1 .85-1.42l7.4-3.9a1.6 1.6 0 0 1 1.5 0l7.4 3.9A1.6 1.6 0 0 1 21 7.9z"/><path d="M3.3 7.1L12 11.7l8.7-4.6M12 21.3V11.7"/></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 21.5s7.5-3.6 7.5-9.5V5.6L12 2.5 4.5 5.6V12c0 5.9 7.5 9.5 7.5 9.5z"/><path d="M9 12l2.1 2.1L15.4 9.8"/></symbol>
    <symbol id="i-dollar" viewBox="0 0 24 24"><path d="M12 2.5v19M16.4 6.6H9.9a3.1 3.1 0 0 0 0 6.2h4.2a3.1 3.1 0 0 1 0 6.2H7"/></symbol>
    <symbol id="i-list" viewBox="0 0 24 24"><path d="M8.5 6.5H21M8.5 12H21M8.5 17.5H21M3.4 6.5h.01M3.4 12h.01M3.4 17.5h.01"/></symbol>
    <symbol id="i-cylinder" viewBox="0 0 24 24"><ellipse cx="12" cy="6" rx="8" ry="3.2"/><path d="M4 6v12c0 1.77 3.58 3.2 8 3.2s8-1.43 8-3.2V6M4 12c0 1.77 3.58 3.2 8 3.2s8-1.43 8-3.2"/></symbol>
    <symbol id="i-table" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9.5h18M9.5 9.5V20"/></symbol>
    <symbol id="i-linkedin" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></symbol>
    <symbol id="i-facebook" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></symbol>
    <symbol id="i-instagram" viewBox="0 0 24 24"><rect x="2.5" y="2.5" width="19" height="19" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.1" fill="currentColor" stroke="none"/></symbol>
    <symbol id="i-youtube" viewBox="0 0 24 24"><path d="M22.5 7.4a2.8 2.8 0 0 0-2-2C18.8 5 12 5 12 5s-6.8 0-8.5.4a2.8 2.8 0 0 0-2 2A29 29 0 0 0 1.1 12a29 29 0 0 0 .4 4.6 2.8 2.8 0 0 0 2 2C5.2 19 12 19 12 19s6.8 0 8.5-.4a2.8 2.8 0 0 0 2-2 29 29 0 0 0 .4-4.6 29 29 0 0 0-.4-4.6z"/><path d="M9.9 15.1l5.7-3.1-5.7-3.1z"/></symbol>
    <symbol id="i-tiktok" viewBox="0 0 24 24"><path d="M16.2 2.5c.4 2.5 1.9 4 4.3 4.2v3.1c-1.5.15-2.9-.25-4.3-1.05v5.9a5.9 5.9 0 1 1-5.05-5.85v3.2a2.75 2.75 0 1 0 1.95 2.65V2.5z"/></symbol>
    <symbol id="i-whatsapp" viewBox="0 0 24 24"><path d="M21 11.6a8.9 8.9 0 0 1-13.1 7.85L3 21l1.6-4.75A8.9 8.9 0 1 1 21 11.6z"/><path d="M8.9 8.1c.2-.45.42-.46.6-.47h.5c.17 0 .4-.06.62.47l.85 2.05c.07.17.12.37 0 .57l-.4.6c-.1.13-.2.28-.09.48a7.1 7.1 0 0 0 3.3 2.87c.22.1.36.09.5-.05l.6-.7c.16-.2.32-.16.53-.09l1.9.9c.22.1.37.16.42.25.06.1.06.5-.13 1a2.3 2.3 0 0 1-1.55 1.1c-.4.04-.78.2-2.65-.55a9.4 9.4 0 0 1-4.5-3.98c-.32-.53-.98-1.7-.98-3.25a3.6 3.6 0 0 1 .96-2.4z"/></symbol>
  </defs>
</svg>

<a class="skip-link" href="#main">Skip to content</a>

<header class="site-header" id="siteHeader">
  <div class="container header__inner">

    <a href="index.php" class="brand" aria-label="HANIU — home">
      <span class="brand__mark">
        <span class="brand__n">N</span>
        <span class="brand__word">HANIU</span>
      </span>
    </a>

    <nav class="nav" id="primaryNav" aria-label="Primary">
      <ul class="nav__list">
        <li class="nav__item"><a class="nav__link<?= $isActive('home') ?>" href="index.php"<?= $activeNav === 'home' ? ' aria-current="page"' : '' ?>>Home</a></li>
        <li class="nav__item"><a class="nav__link<?= $isActive('about') ?>" href="about-us.php"<?= $activeNav === 'about' ? ' aria-current="page"' : '' ?>>About</a></li>

        <li class="nav__item has-dropdown">
          <button class="nav__link nav__toggle" aria-expanded="false" aria-haspopup="true">
            Vehicles <svg class="nav__caret"><use href="#i-chevron-down"/></svg>
          </button>
          <div class="dropdown">
            <ul class="dropdown__list">
              <li><a href="electric-bicycles.php"><span class="dropdown__dot"></span>Electric Bicycle<small>Urban mobility</small></a></li>
              <li><a href="index.php#portfolio"><span class="dropdown__dot"></span>Electric Bike<small>High performance</small></a></li>
              <li><a href="index.php#portfolio"><span class="dropdown__dot"></span>Electric Three Wheeler<small>Cargo &amp; utility</small></a></li>
              <li><a href="index.php#portfolio"><span class="dropdown__dot"></span>Electric Four Wheeler<small>Leisure &amp; transport</small></a></li>
            </ul>
          </div>
        </li>

        <li class="nav__item has-dropdown">
          <button class="nav__link nav__toggle" aria-expanded="false" aria-haspopup="true">
            Parts <svg class="nav__caret"><use href="#i-chevron-down"/></svg>
          </button>
          <div class="dropdown">
            <ul class="dropdown__list">
              <li><a href="motors-controllers.php"><span class="dropdown__dot"></span>Motors &amp; Controllers<small>Wuxi powertrain base</small></a></li>
              <li><a href="index.php#factory"><span class="dropdown__dot"></span>Batteries &amp; Chargers<small>Lithium &amp; lead-acid</small></a></li>
              <li><a href="index.php#factory"><span class="dropdown__dot"></span>Frames &amp; Body Parts<small>In-house welding</small></a></li>
              <li><a href="index.php#factory"><span class="dropdown__dot"></span>Wiring Harness<small>Custom looms</small></a></li>
              <li><a href="contact.php#contact-form" class="dropdown__all">Request spare parts list <svg><use href="#i-arrow-right"/></svg></a></li>
            </ul>
          </div>
        </li>

        <li class="nav__item"><a class="nav__link<?= $isActive('blog') ?>" href="blog.php"<?= $activeNav === 'blog' ? ' aria-current="page"' : '' ?>>Blog</a></li>
        <li class="nav__item nav__item--cta"><a class="btn btn--red btn--sm" href="contact.php">Contact</a></li>
      </ul>
    </nav>

    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false" aria-controls="primaryNav">
      <span></span><span></span><span></span>
    </button>

  </div>
  <span class="header__progress" id="headerProgress"></span>
</header>
<div class="nav-scrim" id="navScrim"></div>

<main id="main">
