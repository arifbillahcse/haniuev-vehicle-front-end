<?php
require __DIR__ . '/config.php';
require __DIR__ . '/includes/inquiry-handler.php';

$featured = db_all('SELECT * FROM products WHERE featured = 1 ORDER BY sort_order LIMIT 6');

$pageTitle = 'Home | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = "HANIU is China's premier B2B manufacturer of electric tricycles, e-bicycles, e-motorcycles and four-wheelers. 200,000m² Tianjin manufacturing base, OEM/ODM services, export to 11+ countries.";
$activeNav = 'home';
require __DIR__ . '/includes/header.php';
?>

<!-- ============================================================
     HERO
     ============================================================ -->
<section class="hero">
  <div class="hero__bg" id="heroBg">
    <div class="media media--fill" data-label="Factory floor · 1920×1080">
      <img src="assets/images/home-hero.jpg" alt="HANIU assembly line in Tianjin">
    </div>
  </div>
  <div class="hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container hero__inner">
    <div class="hero__copy">
      <p class="eyebrow eyebrow--light" data-reveal><span class="eyebrow__dot"></span>HANIU GLOBAL EV MANUFACTURING</p>
      <h1 class="hero__title">
        <span data-reveal data-reveal-delay="80">Engineered for</span>
        <span class="is-muted" data-reveal data-reveal-delay="160">Mass Production.</span>
        <span data-reveal data-reveal-delay="240">Built for the World.</span>
      </h1>
      <p class="hero__lead" data-reveal data-reveal-delay="320">
        China's premier B2B manufacturer of electric mobility solutions. With a 200,000m²
        intelligent manufacturing base, we empower global distributors with full-category EV
        products, rapid innovation, and unmatched production scale.
      </p>
      <div class="hero__actions" data-reveal data-reveal-delay="400">
        <a class="btn btn--red" href="#inquiry">Become a Distributor <svg><use href="#i-arrow-right"/></svg></a>
        <a class="btn btn--ghost" href="#factory">Explore Factory Capabilities</a>
      </div>
    </div>

    <div class="hero__stats">
      <div class="glass-card" data-reveal data-reveal-delay="200">
        <svg class="glass-card__icon"><use href="#i-building"/></svg>
        <p class="glass-card__num" data-count="200" data-suffix="K+">0</p>
        <p class="glass-card__label">SQ.M HQ BASE</p>
      </div>
      <div class="glass-card glass-card--drop" data-reveal data-reveal-delay="300">
        <svg class="glass-card__icon"><use href="#i-globe"/></svg>
        <p class="glass-card__num" data-count="11" data-suffix="+">0</p>
        <p class="glass-card__label">EXPORT MARKETS</p>
      </div>
      <div class="glass-card" data-reveal data-reveal-delay="400">
        <svg class="glass-card__icon"><use href="#i-check-badge"/></svg>
        <p class="glass-card__num glass-card__num--sm">WMI &amp; EEC</p>
        <p class="glass-card__label">GLOBAL CERTIFIED</p>
      </div>
      <div class="glass-card glass-card--drop" data-reveal data-reveal-delay="500">
        <svg class="glass-card__icon"><use href="#i-users"/></svg>
        <p class="glass-card__num" data-count="500" data-suffix="+">0</p>
        <p class="glass-card__label">SKILLED WORKFORCE</p>
      </div>
    </div>
  </div>

  <a class="hero__scroll" href="#about" aria-label="Scroll to content">
    <span>SCROLL</span>
    <span class="hero__scroll-line"><i></i></span>
  </a>
</section>

<!-- ============================================================
     BRAND POSITIONING
     ============================================================ -->
<section class="section" id="about">
  <div class="container split">
    <div class="split__text">
      <p class="eyebrow" data-reveal><span class="eyebrow__rule"></span>BRAND POSITIONING</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">
        Not Just a Manufacturer&nbsp;--<br><span class="is-red">Your Global EV Partner</span>
      </h2>
      <p class="lead" data-reveal data-reveal-delay="140">
        Founded in Tianjin, HANIU has grown from a regional EV producer into a globally recognized
        brand with 500+ offline stores across China and a growing international presence. We combine
        industrial-scale production with agile R&amp;D to deliver products that win markets.
      </p>
      <p class="lead" data-reveal data-reveal-delay="200">
        Our mission is to provide overseas distributors, wholesalers, and OEM buyers with the most
        competitive, reliable, and innovative electric vehicle solutions -- backed by a complete
        supply chain, rigorous quality control, and dedicated after-sales support.
      </p>

      <div class="ministats" data-reveal data-reveal-delay="260">
        <div class="ministat"><p class="ministat__num" data-count="500" data-suffix="+">0</p><p class="ministat__label">CHINA STORES</p></div>
        <div class="ministat"><p class="ministat__num" data-count="6">0</p><p class="ministat__label">PRODUCTION BASES</p></div>
        <div class="ministat"><p class="ministat__num" data-count="15" data-suffix="+">0</p><p class="ministat__label">YEARS EXPERIENCE</p></div>
      </div>
    </div>

    <div class="split__visual" data-reveal data-reveal-delay="160">
      <span class="deco-square"></span>
      <div class="media media--16x9 media--zoom" data-label="Aerial · Tianjin HQ">
        <img src="assets/images/hq-aerial.jpg" alt="Aerial view of HANIU Tianjin manufacturing base">
      </div>
      <div class="stat-badge">
        <p class="stat-badge__num">200,000 m<sup>2</sup></p>
        <p class="stat-badge__label">Tianjin HQ Manufacturing Base</p>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     PRODUCT PORTFOLIO
     ============================================================ -->
<section class="section section--alt" id="portfolio">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>PRODUCT PORTFOLIO<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Comprehensive EV Portfolio</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        From nimble two-wheelers to robust four-wheelers, HANIU offers a full spectrum of electric
        vehicles designed for diverse market demands, backed by continuous R&amp;D.
      </p>
    </header>

    <div class="cat-grid">
      <a class="cat" href="#models" data-reveal data-reveal-delay="0">
        <div class="media media--cat" data-label="E-Tricycle"><img src="assets/images/cat-tricycle.jpg" alt="HANIU electric tricycle"></div>
        <div class="cat__body">
          <p class="cat__kicker">CARGO &amp; UTILITY</p>
          <h3 class="cat__title">E-Tricycles</h3>
        </div>
        <span class="cat__arrow"><svg><use href="#i-arrow-right"/></svg></span>
      </a>
      <a class="cat" href="electric-bicycles.php" data-reveal data-reveal-delay="90">
        <div class="media media--cat" data-label="E-Bicycle"><img src="assets/images/cat-bicycle.jpg" alt="HANIU electric bicycle"></div>
        <div class="cat__body">
          <p class="cat__kicker">URBAN MOBILITY</p>
          <h3 class="cat__title">E-Bicycles</h3>
        </div>
        <span class="cat__arrow"><svg><use href="#i-arrow-right"/></svg></span>
      </a>
      <a class="cat" href="#models" data-reveal data-reveal-delay="180">
        <div class="media media--cat" data-label="E-Motorcycle"><img src="assets/images/cat-motorcycle.jpg" alt="HANIU electric motorcycle"></div>
        <div class="cat__body">
          <p class="cat__kicker">HIGH PERFORMANCE</p>
          <h3 class="cat__title">E-Motorcycles</h3>
        </div>
        <span class="cat__arrow"><svg><use href="#i-arrow-right"/></svg></span>
      </a>
      <a class="cat" href="#models" data-reveal data-reveal-delay="270">
        <div class="media media--cat" data-label="Four-Wheeler"><img src="assets/images/cat-fourwheeler.jpg" alt="HANIU electric four-wheeler"></div>
        <div class="cat__body">
          <p class="cat__kicker">LEISURE &amp; TRANSPORT</p>
          <h3 class="cat__title">Four-Wheelers</h3>
        </div>
        <span class="cat__arrow"><svg><use href="#i-arrow-right"/></svg></span>
      </a>
    </div>
  </div>
</section>

<!-- ============================================================
     FACTORY STRENGTH
     ============================================================ -->
<section class="section section--dark" id="factory">
  <div class="grid-texture"></div>
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center eyebrow--light" data-reveal><span class="eyebrow__rule"></span>FACTORY STRENGTH<span class="eyebrow__rule"></span></p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">Industrial-Scale Power</h2>
      <p class="sec-head__sub sec-head__sub--light" data-reveal data-reveal-delay="140">
        Built to fulfill the most demanding global orders with precision, speed, and consistency.
      </p>
    </header>

    <div class="statbar">
      <div class="statbox" data-reveal data-reveal-delay="0">
        <svg class="statbox__icon"><use href="#i-building"/></svg>
        <p class="statbox__num"><span data-count="200000" data-format="comma">0</span> m<sup>2</sup></p>
        <p class="statbox__label">HQ BASE AREA</p>
      </div>
      <div class="statbox" data-reveal data-reveal-delay="60">
        <svg class="statbox__icon"><use href="#i-pin"/></svg>
        <p class="statbox__num" data-count="6">0</p>
        <p class="statbox__label">PRODUCTION BASES</p>
      </div>
      <div class="statbox" data-reveal data-reveal-delay="120">
        <svg class="statbox__icon"><use href="#i-users"/></svg>
        <p class="statbox__num" data-count="500" data-suffix="+">0</p>
        <p class="statbox__label">SKILLED WORKERS</p>
      </div>
      <div class="statbox" data-reveal data-reveal-delay="180">
        <svg class="statbox__icon"><use href="#i-cart"/></svg>
        <p class="statbox__num" data-count="500" data-suffix="+">0</p>
        <p class="statbox__label">CHINA STORES</p>
      </div>
      <div class="statbox" data-reveal data-reveal-delay="240">
        <svg class="statbox__icon"><use href="#i-globe"/></svg>
        <p class="statbox__num" data-count="11" data-suffix="+">0</p>
        <p class="statbox__label">EXPORT COUNTRIES</p>
      </div>
      <div class="statbox" data-reveal data-reveal-delay="300">
        <svg class="statbox__icon"><use href="#i-check-circle"/></svg>
        <p class="statbox__num" data-count="5" data-suffix="+">0</p>
        <p class="statbox__label">CERTIFICATIONS</p>
      </div>
    </div>

    <div class="fact">
      <div class="fact__visual" data-reveal>
        <div class="media media--4x3 media--zoom" data-label="Main assembly hall">
          <img src="assets/images/factory-floor.jpg" alt="HANIU main production facility interior">
        </div>
        <div class="fact__caption">
          <span class="tag tag--red">TIANJIN HQ</span>
          <h3 class="fact__caption-title">Main Production Facility</h3>
        </div>
      </div>

      <div class="fact__list">
        <article class="feat" data-reveal data-reveal-delay="80">
          <span class="feat__check"><svg><use href="#i-check-circle"/></svg></span>
          <div>
            <h3 class="feat__title">Full In-House Workshops</h3>
            <p class="feat__text">Frame welding, baking paint, injection molding, motor assembly, and wiring harness -- all under one roof for complete quality control.</p>
          </div>
        </article>
        <article class="feat" data-reveal data-reveal-delay="160">
          <span class="feat__check"><svg><use href="#i-check-circle"/></svg></span>
          <div>
            <h3 class="feat__title">Dedicated R&amp;D Center</h3>
            <p class="feat__text">Our engineering team continuously develops new models and updates existing lines to keep distributors ahead of market trends.</p>
          </div>
        </article>
        <article class="feat" data-reveal data-reveal-delay="240">
          <span class="feat__check"><svg><use href="#i-check-circle"/></svg></span>
          <div>
            <h3 class="feat__title">Complete After-Sales System</h3>
            <p class="feat__text">Comprehensive spare parts inventory, technical documentation, and dedicated after-sales support for every market we serve.</p>
          </div>
        </article>
        <article class="feat" data-reveal data-reveal-delay="320">
          <span class="feat__check"><svg><use href="#i-check-circle"/></svg></span>
          <div>
            <h3 class="feat__title">Large-Volume Fulfillment</h3>
            <p class="feat__text">Multi-base production network ensures we can handle high-volume orders without compromising lead times or quality standards.</p>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     PRODUCTION NETWORK
     ============================================================ -->
<section class="section">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>PRODUCTION NETWORK<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Multi-Base Manufacturing</h2>
      <p class="sec-head__sub" data-reveal data-reveal-delay="140">
        Strategic production facilities across Tianjin, Shandong, and Wuxi ensure resilient supply
        chains and rapid order fulfillment.
      </p>
    </header>

    <div class="base-grid">
      <article class="base base--dark" data-reveal data-reveal-delay="0">
        <span class="tag tag--red">4 BASES</span>
        <h3 class="base__title">Tianjin</h3>
        <p class="base__text">Headquarters and primary manufacturing hub. Houses R&amp;D center, main assembly lines, and quality control labs.</p>
      </article>
      <article class="base" data-reveal data-reveal-delay="90">
        <span class="tag tag--navy">1 BASE</span>
        <h3 class="base__title">Shandong</h3>
        <p class="base__text">Specialized production facility focused on heavy-duty tricycles and cargo electric vehicles for bulk export.</p>
      </article>
      <article class="base" data-reveal data-reveal-delay="180">
        <span class="tag tag--navy">1 BASE</span>
        <h3 class="base__title">Wuxi</h3>
        <p class="base__text">Advanced electronics and motor manufacturing base, producing core EV powertrain components in-house.</p>
      </article>
    </div>

    <div class="workshop" data-reveal>
      <h3 class="workshop__title">In-House Workshop Capabilities</h3>
      <div class="workshop__grid">
        <div class="wtile" data-reveal data-reveal-delay="0"><span class="wtile__icon"><svg><use href="#i-sliders"/></svg></span><p>FRAME WELDING</p></div>
        <div class="wtile" data-reveal data-reveal-delay="70"><span class="wtile__icon"><svg><use href="#i-spray"/></svg></span><p>BAKING PAINT</p></div>
        <div class="wtile" data-reveal data-reveal-delay="140"><span class="wtile__icon"><svg><use href="#i-flask"/></svg></span><p>INJECTION MOLDING</p></div>
        <div class="wtile" data-reveal data-reveal-delay="210"><span class="wtile__icon"><svg><use href="#i-gear"/></svg></span><p>MOTOR ASSEMBLY</p></div>
        <div class="wtile" data-reveal data-reveal-delay="280"><span class="wtile__icon"><svg><use href="#i-bolt"/></svg></span><p>WIRING HARNESS</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     GLOBAL REACH
     ============================================================ -->
<section class="section section--dark" id="markets">
  <div class="grid-texture"></div>
  <div class="container split split--wide">
    <div class="split__text">
      <p class="eyebrow eyebrow--light" data-reveal><span class="eyebrow__rule"></span>GLOBAL REACH</p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">Trusted Across<br>11+ Countries</h2>
      <p class="lead lead--light" data-reveal data-reveal-delay="140">
        HANIU products are actively distributed across Europe, South America, Southeast Asia, and the
        CIS region. Our export experience means we understand local regulations, certification
        requirements, and market preferences.
      </p>

      <div class="region-list">
        <div class="region" data-reveal data-reveal-delay="200"><span class="region__dot"></span><p><b>Europe:</b> Romania, Lithuania, Bulgaria, Serbia, Turkey, Ukraine</p></div>
        <div class="region" data-reveal data-reveal-delay="260"><span class="region__dot"></span><p><b>South America:</b> Colombia, Brazil, Peru</p></div>
        <div class="region" data-reveal data-reveal-delay="320"><span class="region__dot"></span><p><b>Asia &amp; CIS:</b> Myanmar, Russia</p></div>
      </div>

      <a class="link-red" href="#inquiry" data-reveal data-reveal-delay="380">Inquire About Your Market <svg><use href="#i-arrow-right"/></svg></a>
    </div>

    <div class="split__visual" data-reveal data-reveal-delay="160">
      <div class="worldmap">
        <svg class="worldmap__svg" viewBox="0 0 640 340" role="img" aria-label="World map showing HANIU export markets">
          <defs>
            <pattern id="dots" width="7" height="7" patternUnits="userSpaceOnUse">
              <circle cx="2" cy="2" r="1.4" fill="rgba(150,180,225,.42)"/>
            </pattern>
          </defs>
          <g fill="url(#dots)">
            <path d="M78 60h96v18h-30v14h-22v16h-26v18H82v-22H62V78h16z"/>
            <path d="M120 128h44v20h-12v26h-16v30h-14v-34h-10v-28h8z"/>
            <path d="M150 196h34v24h-8v34h-14v30h-12v-40h-8v-32h8z"/>
            <path d="M262 46h132v16h-34v14h-40v14h-42V62h-16z"/>
            <path d="M256 84h108v18h-20v18h-30v18h-30v-20h-28z"/>
            <path d="M282 132h72v26h-14v34h-16v34h-16v-38h-14v-34h-12z"/>
            <path d="M406 60h176v20h-30v18h-34v18h-40V84h-40z"/>
            <path d="M414 108h124v22h-26v24h-36v24h-36v-30h-26z"/>
            <path d="M470 172h86v22h-22v22h-26v-18h-24z"/>
            <path d="M500 232h56v18h-18v22h-20v-20h-18z"/>
          </g>
        </svg>

        <span class="pin" style="--x:40%;--y:10%" data-reveal data-reveal-delay="200"><i></i>Lithuania</span>
        <span class="pin" style="--x:75%;--y:10%" data-reveal data-reveal-delay="240"><i></i>Russia</span>
        <span class="pin" style="--x:33%;--y:25%" data-reveal data-reveal-delay="280"><i></i>Romania</span>
        <span class="pin" style="--x:58%;--y:25%" data-reveal data-reveal-delay="320"><i></i>Bulgaria</span>
        <span class="pin" style="--x:30%;--y:40%" data-reveal data-reveal-delay="360"><i></i>Serbia</span>
        <span class="pin" style="--x:63%;--y:40%" data-reveal data-reveal-delay="400"><i></i>Ukraine</span>
        <span class="pin" style="--x:46%;--y:55%" data-reveal data-reveal-delay="440"><i></i>Turkey</span>
        <span class="pin" style="--x:80%;--y:55%" data-reveal data-reveal-delay="480"><i></i>Myanmar</span>
        <span class="pin" style="--x:14%;--y:70%" data-reveal data-reveal-delay="520"><i></i>Colombia</span>
        <span class="pin" style="--x:36%;--y:70%" data-reveal data-reveal-delay="560"><i></i>Brazil</span>
        <span class="pin" style="--x:19%;--y:86%" data-reveal data-reveal-delay="600"><i></i>Peru</span>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     WHY HANIU
     ============================================================ -->
<section class="section">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>WHY HANIU<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">The HANIU Advantage</h2>
      <p class="sec-head__sub" data-reveal data-reveal-delay="140">
        Six compelling reasons why leading global distributors choose HANIU as their long-term EV
        manufacturing partner.
      </p>
    </header>

    <div class="adv-grid">
      <article class="adv" data-reveal data-reveal-delay="0">
        <span class="adv__no">01</span>
        <span class="adv__icon"><svg><use href="#i-grid"/></svg></span>
        <h3 class="adv__title">Widest Product Range</h3>
        <p class="adv__text">From e-bikes to four-wheelers, our full-category portfolio means you can source everything from one trusted partner -- reducing complexity and cost.</p>
      </article>
      <article class="adv" data-reveal data-reveal-delay="80">
        <span class="adv__no">02</span>
        <span class="adv__icon"><svg><use href="#i-bolt"/></svg></span>
        <h3 class="adv__title">Rapid Product Updates</h3>
        <p class="adv__text">Our in-house R&amp;D center continuously develops new models and refreshes existing lines, ensuring you always have the latest products to offer your customers.</p>
      </article>
      <article class="adv" data-reveal data-reveal-delay="160">
        <span class="adv__no">03</span>
        <span class="adv__icon"><svg><use href="#i-building"/></svg></span>
        <h3 class="adv__title">Mass Production Capacity</h3>
        <p class="adv__text">Six production bases with 200,000m² of manufacturing space ensure we can fulfill large-volume orders on time, every time.</p>
      </article>
      <article class="adv" data-reveal data-reveal-delay="0">
        <span class="adv__no">04</span>
        <span class="adv__icon"><svg><use href="#i-globe"/></svg></span>
        <h3 class="adv__title">Proven Global Track Record</h3>
        <p class="adv__text">Active distribution across 11+ countries with satisfied long-term partners. Our export experience means smoother logistics and fewer surprises.</p>
      </article>
      <article class="adv" data-reveal data-reveal-delay="80">
        <span class="adv__no">05</span>
        <span class="adv__icon"><svg><use href="#i-check-circle"/></svg></span>
        <h3 class="adv__title">Established Brand Credibility</h3>
        <p class="adv__text">500+ retail stores across China validate HANIU as a market-proven brand. Our domestic success translates into a product quality you can confidently sell.</p>
      </article>
      <article class="adv" data-reveal data-reveal-delay="160">
        <span class="adv__no">06</span>
        <span class="adv__icon"><svg><use href="#i-lifebuoy"/></svg></span>
        <h3 class="adv__title">Complete After-Sales Support</h3>
        <p class="adv__text">Dedicated after-sales service with comprehensive spare parts availability, technical support, and documentation to help you serve your end customers effectively.</p>
      </article>
    </div>
  </div>
</section>

<!-- ============================================================
     PROMOTIONAL VIDEO
     ============================================================ -->
<section class="section section--alt" id="video">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>SEE HANIU IN ACTION<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Watch Our Story</h2>
      <p class="sec-head__sub" data-reveal data-reveal-delay="140">
        A closer look at our manufacturing base, product range, and commitment to quality.
      </p>
    </header>

    <div class="video-embed" data-reveal data-reveal-delay="180">
      <iframe src="https://www.youtube.com/embed/Zn6scKf7k_0" title="HANIU Electric Vehicle promotional video" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- ============================================================
     QUALITY ASSURANCE
     ============================================================ -->
<section class="section section--dark" id="quality">
  <div class="grid-texture"></div>
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center eyebrow--light" data-reveal><span class="eyebrow__rule"></span>QUALITY ASSURANCE<span class="eyebrow__rule"></span></p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">Certified Quality,<br>Global Standards</h2>
      <p class="sec-head__sub sec-head__sub--light" data-reveal data-reveal-delay="140">
        Every HANIU product is manufactured under strict quality management systems and validated by
        internationally recognized certifications.
      </p>
    </header>

    <div class="cert-grid">
      <div class="cert" data-reveal data-reveal-delay="0"><svg class="cert__icon"><use href="#i-check-badge"/></svg><p class="cert__code">ISO 9001:2005</p><p class="cert__name">Quality Management System</p></div>
      <div class="cert" data-reveal data-reveal-delay="70"><svg class="cert__icon"><use href="#i-check-badge"/></svg><p class="cert__code">EEC</p><p class="cert__name">European Economic Community</p></div>
      <div class="cert" data-reveal data-reveal-delay="140"><svg class="cert__icon"><use href="#i-check-badge"/></svg><p class="cert__code">COC</p><p class="cert__name">Certificate of Conformity</p></div>
      <div class="cert" data-reveal data-reveal-delay="210"><svg class="cert__icon"><use href="#i-check-badge"/></svg><p class="cert__code">WMI</p><p class="cert__name">World Manufacturer Identifier</p></div>
      <div class="cert" data-reveal data-reveal-delay="280"><svg class="cert__icon"><use href="#i-check-badge"/></svg><p class="cert__code">CCC</p><p class="cert__name">China Compulsory Certification</p></div>
    </div>

    <div class="commit" data-reveal>
      <div class="commit__body">
        <h3 class="commit__title">Our Quality Commitment</h3>
        <p class="commit__text">
          HANIU's quality management system covers every stage of production -- from raw material
          inspection to final product testing. Our dedicated quality control team ensures each unit
          meets or exceeds international standards before shipment.
        </p>
        <ul class="commit__list">
          <li>Incoming material inspection</li>
          <li>In-process quality checks</li>
          <li>Final product testing</li>
          <li>Pre-shipment inspection</li>
          <li>Third-party audit ready</li>
          <li>Full traceability records</li>
        </ul>
      </div>
      <div class="commit__visual">
        <div class="media media--4x3 media--zoom" data-label="QC lab · 300×200">
          <img src="assets/images/quality-lab.jpg" alt="HANIU quality control inspection">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     POPULAR MODELS  (from the products table, featured = 1)
     ============================================================ -->
<section class="section section--alt" id="models">
  <div class="container">
    <header class="sec-head sec-head--row">
      <div>
        <p class="eyebrow" data-reveal><span class="eyebrow__rule"></span>HOT PRODUCTS</p>
        <h2 class="h2" data-reveal data-reveal-delay="80">Popular Models</h2>
      </div>
      <a class="link-dark" href="#inquiry" data-reveal data-reveal-delay="120">View All Products <svg><use href="#i-arrow-right"/></svg></a>
    </header>

    <div class="prod-grid">
      <?php foreach ($featured as $i => $product): ?>
        <?php $delay = ($i % 3) * 80; require __DIR__ . '/includes/product-card.php'; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     INQUIRY
     ============================================================ -->
<section class="section" id="inquiry">
  <div class="container inquiry">
    <aside class="inq-panel" data-reveal>
      <div class="grid-texture"></div>
      <div class="inq-panel__inner">
        <p class="eyebrow eyebrow--light"><span class="eyebrow__rule"></span>GET IN TOUCH</p>
        <h2 class="h2 h2--light">Ready to Partner<br>with HANIU?</h2>
        <p class="lead lead--light">
          Whether you're a distributor, wholesaler, or OEM buyer -- our team is ready to discuss
          pricing, minimum order quantities, customization options, and export logistics.
        </p>
        <ul class="inq-panel__list">
          <li>Competitive wholesale pricing</li>
          <li>Flexible MOQ for new partners</li>
          <li>OEM/ODM available</li>
          <li>Full export documentation support</li>
        </ul>
        <hr class="rule rule--light">
        <div class="inq-panel__meta">
          <span><svg><use href="#i-clock"/></svg> Reply within 24 hours</span>
          <span><svg><use href="#i-phone"/></svg> Multilingual support</span>
        </div>
      </div>
    </aside>

    <div class="inq-form" data-reveal data-reveal-delay="120">
      <h3 class="inq-form__title">Send an Inquiry</h3>
      <p class="inq-form__sub">Fill in the form and our export team will get back to you promptly.</p>

      <form id="inquiryForm" method="post">
        <?php require __DIR__ . '/includes/inquiry-fields.php'; ?>
      </form>
    </div>
  </div>
</section>

<?php
$ctaHref = '#inquiry';
require __DIR__ . '/includes/footer.php';
