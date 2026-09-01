<?php
/**
 * Shared footer, identical across every page.
 * Expects (optional): $ctaHref — where the "Become a Distributor" button in
 * the footer CTA bar goes. Defaults to the Contact page's form; pages that
 * carry their own inline inquiry form (Home, About) pass their own anchor.
 */
$ctaHref = $ctaHref ?? 'contact.php#contact-form';
?>
</main>

<footer class="footer">

  <div class="footer-cta">
    <div class="grid-texture"></div>
    <div class="container footer-cta__inner">
      <div data-reveal>
        <h2 class="footer-cta__title">Ready to Grow Your EV Business?</h2>
        <p class="footer-cta__sub">Partner with HANIU -- China's leading full-category EV manufacturer.</p>
      </div>
      <a class="btn btn--red" href="<?= h($ctaHref) ?>" data-reveal data-reveal-delay="120">Become a Distributor <svg><use href="#i-arrow-right"/></svg></a>
    </div>
  </div>

  <div class="footer-main">
    <div class="grid-texture"></div>
    <div class="container footer-grid">

      <div class="fcol fcol--brand" data-reveal data-reveal-delay="0">
        <p class="footer-logo">HANIU</p>
        <p class="fcol__about">
          China's premier B2B electric vehicle manufacturer. Full-category EV production, rapid
          OEM/ODM fulfillment, and global distribution support from our 200,000 m² Tianjin
          headquarters.
        </p>
      </div>

      <div class="fcol" data-reveal data-reveal-delay="80">
        <h3 class="fcol__title"><span class="fcol__rule"></span>PRODUCTS</h3>
        <ul class="flist">
          <li><a href="index.php#portfolio"><svg><use href="#i-chevron-right"/></svg>Electric Motorcycles</a></li>
          <li><a href="electric-bicycles.php"><svg><use href="#i-chevron-right"/></svg>Electric Bicycles</a></li>
          <li><a href="index.php#portfolio"><svg><use href="#i-chevron-right"/></svg>Electric Tricycles</a></li>
          <li><a href="index.php#portfolio"><svg><use href="#i-chevron-right"/></svg>Four-Wheelers</a></li>
        </ul>
      </div>

      <div class="fcol" data-reveal data-reveal-delay="160">
        <h3 class="fcol__title"><span class="fcol__rule"></span>COMPANY</h3>
        <ul class="flist">
          <li><a href="about-us.php"><svg><use href="#i-chevron-right"/></svg>About HANIU</a></li>
          <li><a href="index.php#factory"><svg><use href="#i-chevron-right"/></svg>Factory Tour</a></li>
          <li><a href="blog.php"><svg><use href="#i-chevron-right"/></svg>News &amp; Updates</a></li>
          <li><a href="contact.php"><svg><use href="#i-chevron-right"/></svg>Contact Us</a></li>
        </ul>

        <div class="highlights">
          <p class="highlights__title">FACTORY HIGHLIGHTS</p>
          <div class="highlight"><b data-count="200" data-suffix="K+">0</b><span>m² Production Base</span></div>
          <div class="highlight"><b data-count="500" data-suffix="+">0</b><span>Skilled Employees</span></div>
          <div class="highlight"><b data-count="11" data-suffix="+">0</b><span>Export Countries</span></div>
        </div>
      </div>

      <div class="fcol" data-reveal data-reveal-delay="240">
        <h3 class="fcol__title"><span class="fcol__rule"></span>CONTACT US</h3>
        <ul class="fcontact">
          <li><span class="fcontact__ico"><svg><use href="#i-users"/></svg></span><span>MD Nadimmahmud Jewel (胜利)<br>Foreign Trade Director</span></li>
          <li><span class="fcontact__ico"><svg><use href="#i-pin"/></svg></span><span>哈牛电动车(福达路店)<br>天津市武清区京津科技谷福达路65号</span></li>
          <li><a href="mailto:haniuev@gmail.com"><span class="fcontact__ico"><svg><use href="#i-mail"/></svg></span><span>haniuev@gmail.com</span></a></li>
          <li><a href="tel:+8618841800421"><span class="fcontact__ico"><svg><use href="#i-phone"/></svg></span><span>+86 18841800421</span></a></li>
        </ul>

        <?php $social = settings(); ?>
        <p class="fcol__mini fcol__mini--gap">FOLLOW US</p>
        <ul class="socials">
          <?php if ($social['social_linkedin'] !== ''): ?><li><a href="<?= h($social['social_linkedin']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><svg><use href="#i-linkedin"/></svg></a></li><?php endif; ?>
          <?php if ($social['social_facebook'] !== ''): ?><li><a href="<?= h($social['social_facebook']) ?>" target="_blank" rel="noopener" aria-label="Facebook"><svg><use href="#i-facebook"/></svg></a></li><?php endif; ?>
          <?php if ($social['social_instagram'] !== ''): ?><li><a href="<?= h($social['social_instagram']) ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg><use href="#i-instagram"/></svg></a></li><?php endif; ?>
          <?php if ($social['social_youtube'] !== ''): ?><li><a href="<?= h($social['social_youtube']) ?>" target="_blank" rel="noopener" aria-label="YouTube"><svg><use href="#i-youtube"/></svg></a></li><?php endif; ?>
          <?php if ($social['social_tiktok'] !== ''): ?><li><a href="<?= h($social['social_tiktok']) ?>" target="_blank" rel="noopener" aria-label="TikTok"><svg><use href="#i-tiktok"/></svg></a></li><?php endif; ?>
          <?php if ($social['social_whatsapp'] !== ''): ?><li><a href="<?= h($social['social_whatsapp']) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><svg><use href="#i-whatsapp"/></svg></a></li><?php endif; ?>
        </ul>
      </div>

    </div>
  </div>

  <div class="footer-bottom">
    <div class="container footer-bottom__inner">
      <p>© <span id="year"><?= date('Y') ?></span> HANIU Electric Vehicle Co., Ltd. All rights reserved. · Tianjin Wuqing, China</p>
    </div>
  </div>
</footer>

<button class="to-top" id="toTop" aria-label="Back to top"><svg><use href="#i-arrow-up"/></svg></button>

<div id="google_translate_element" class="notranslate" translate="no" hidden></div>
<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,zh-CN,es,it,pt',
      autoDisplay: false
    }, 'google_translate_element');
  }
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" async></script>
<script src="assets/js/main.js"></script>
</body>
</html>
