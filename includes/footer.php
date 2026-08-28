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
        <p class="fcol__mini">CERTIFICATIONS</p>
        <ul class="cert-chips">
          <li>ISO 9001</li><li>EEC</li><li>COC</li><li>CCC</li><li>WMI</li>
        </ul>
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
          <li><span class="fcontact__ico"><svg><use href="#i-pin"/></svg></span><span>Wuqing District, Tianjin,<br>China</span></li>
          <li><a href="mailto:export@haniu.com"><span class="fcontact__ico"><svg><use href="#i-mail"/></svg></span><span>export@haniu.com</span></a></li>
          <li><a href="tel:+8600000000000"><span class="fcontact__ico"><svg><use href="#i-phone"/></svg></span><span>+86 000 0000 0000</span></a></li>
        </ul>

        <p class="fcol__mini fcol__mini--gap">FOLLOW US</p>
        <ul class="socials">
          <li><a href="#" aria-label="LinkedIn"><svg><use href="#i-linkedin"/></svg></a></li>
          <li><a href="#" aria-label="Facebook"><svg><use href="#i-facebook"/></svg></a></li>
          <li><a href="#" aria-label="Instagram"><svg><use href="#i-instagram"/></svg></a></li>
          <li><a href="#" aria-label="YouTube"><svg><use href="#i-youtube"/></svg></a></li>
          <li><a href="#" aria-label="TikTok"><svg><use href="#i-tiktok"/></svg></a></li>
          <li><a href="#" aria-label="WhatsApp"><svg><use href="#i-whatsapp"/></svg></a></li>
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

<script src="assets/js/main.js"></script>
</body>
</html>
