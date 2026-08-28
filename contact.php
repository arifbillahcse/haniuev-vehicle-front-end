<?php
require __DIR__ . '/config.php';
require __DIR__ . '/includes/inquiry-handler.php';

$pageTitle = 'Contact | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = "Get in touch with HANIU's export team — email, phone, WhatsApp, and factory address for distributors, wholesalers, and OEM buyers.";
$activeNav = 'contact';
$extraCss = ['contact.css'];
require __DIR__ . '/includes/header.php';
?>

<!-- ============================================================
     PAGE HERO
     ============================================================ -->
<section class="page-hero">
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i>GET IN TOUCH</span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80">Let's Start a Conversation</span>
    </h1>
    <p class="page-hero__lead" data-reveal data-reveal-delay="160">
      Have questions about our products, wholesale pricing, or OEM/ODM partnership opportunities?
      Our export team is ready to help -- reach out however works best for you.
    </p>

    <div class="inq-panel__meta" data-reveal data-reveal-delay="240">
      <span><svg><use href="#i-clock"/></svg> Reply within 24 hours</span>
      <span><svg><use href="#i-phone"/></svg> Multilingual support</span>
      <span><svg><use href="#i-globe"/></svg> 11+ export markets served</span>
    </div>
  </div>
</section>

<!-- ============================================================
     QUICK-REFERENCE INFO CARDS
     ============================================================ -->
<section class="section section--alt">
  <div class="container">
    <div class="info-grid">
      <article class="info-card" data-reveal data-reveal-delay="0">
        <span class="info-card__icon"><svg><use href="#i-mail"/></svg></span>
        <h3 class="info-card__title">Email Us</h3>
        <p class="info-card__text"><a href="mailto:export@haniu.com">export@haniu.com</a></p>
      </article>
      <article class="info-card" data-reveal data-reveal-delay="80">
        <span class="info-card__icon"><svg><use href="#i-phone"/></svg></span>
        <h3 class="info-card__title">Call / WhatsApp</h3>
        <p class="info-card__text"><a href="tel:+8600000000000">+86 000 0000 0000</a></p>
      </article>
      <article class="info-card" data-reveal data-reveal-delay="160">
        <span class="info-card__icon"><svg><use href="#i-pin"/></svg></span>
        <h3 class="info-card__title">Visit Our Factory</h3>
        <p class="info-card__text">Wuqing District, Tianjin, China</p>
      </article>
      <article class="info-card" data-reveal data-reveal-delay="240">
        <span class="info-card__icon"><svg><use href="#i-clock"/></svg></span>
        <h3 class="info-card__title">Business Hours</h3>
        <p class="info-card__text">Mon -- Sat, 9:00 -- 18:00<br>China Standard Time (UTC+8)</p>
      </article>
    </div>
  </div>
</section>

<!-- ============================================================
     FORM + FIND US
     ============================================================ -->
<section class="section" id="contact-form">
  <div class="container contact-grid">

    <div class="contact-form-card" data-reveal>
      <h2 class="contact-form-card__title">Send Us a Message</h2>
      <p class="contact-form-card__sub">Fill in the form and our export team will get back to you promptly.</p>

      <form id="inquiryForm" method="post">
        <?php require __DIR__ . '/includes/inquiry-fields.php'; ?>
      </form>
    </div>

    <aside class="contact-side" data-reveal data-reveal-delay="140">
      <div class="contact-side__map">
        <div class="media media--3x2" data-label="Map · Tianjin Wuqing">
          <img src="assets/images/contact-map.jpg" alt="Map of HANIU headquarters in Wuqing District, Tianjin">
        </div>
      </div>
      <div class="contact-side__body">
        <ul class="contact-rows">
          <li>
            <span class="contact-rows__icon"><svg><use href="#i-pin"/></svg></span>
            <div><p class="contact-rows__label">HEADQUARTERS</p><p class="contact-rows__value">Wuqing District, Tianjin, China</p></div>
          </li>
          <li>
            <span class="contact-rows__icon"><svg><use href="#i-mail"/></svg></span>
            <div><p class="contact-rows__label">EMAIL</p><a class="contact-rows__value" href="mailto:export@haniu.com">export@haniu.com</a></div>
          </li>
        </ul>

        <h3 class="contact-side__title">Follow Us</h3>
        <ul class="socials">
          <li><a href="#" aria-label="LinkedIn"><svg><use href="#i-linkedin"/></svg></a></li>
          <li><a href="#" aria-label="Facebook"><svg><use href="#i-facebook"/></svg></a></li>
          <li><a href="#" aria-label="Instagram"><svg><use href="#i-instagram"/></svg></a></li>
          <li><a href="#" aria-label="YouTube"><svg><use href="#i-youtube"/></svg></a></li>
          <li><a href="#" aria-label="TikTok"><svg><use href="#i-tiktok"/></svg></a></li>
          <li><a href="#" aria-label="WhatsApp"><svg><use href="#i-whatsapp"/></svg></a></li>
        </ul>
      </div>
    </aside>

  </div>
</section>

<?php
$ctaHref = '#contact-form';
require __DIR__ . '/includes/footer.php';
