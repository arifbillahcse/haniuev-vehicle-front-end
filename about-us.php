<?php
require __DIR__ . '/config.php';
require __DIR__ . '/includes/inquiry-handler.php';

$pageTitle = 'About | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = "HANIU is China's premier electric vehicle manufacturer — 200,000m² Tianjin headquarters, six production bases, 500+ offline stores and export to 11+ countries.";
$activeNav = 'about';
$extraCss = ['about.css'];
require __DIR__ . '/includes/header.php';
?>

<!-- ============================================================
     PAGE HERO
     ============================================================ -->
<section class="page-hero">
  <div class="page-hero__bg" id="heroBg">
    <div class="media media--fill" data-label="Workshop · 1920×900">
      <img src="assets/images/about-hero.jpg" alt="HANIU technicians on the production line">
    </div>
  </div>
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i>ABOUT HANIU</span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80">More Than a Factory.</span>
      <span data-reveal data-reveal-delay="160">A Global <em>EV Brand.</em></span>
    </h1>
    <p class="page-hero__lead" data-reveal data-reveal-delay="240">
      HANIU is China's premier electric vehicle manufacturer -- engineering world-class e-tricycles,
      e-bicycles, e-motorcycles, and four-wheelers for distributors and partners across the globe.
      Born in Tianjin, trusted worldwide.
    </p>

    <div class="hero-stats" data-reveal data-reveal-delay="320">
      <div class="hero-stat"><p class="hero-stat__num" data-count="20" data-suffix="+">0</p><p class="hero-stat__label">YEARS EXPERIENCE</p></div>
      <div class="hero-stat"><p class="hero-stat__num" data-count="500" data-suffix="+">0</p><p class="hero-stat__label">OFFLINE STORES</p></div>
      <div class="hero-stat"><p class="hero-stat__num" data-count="11" data-suffix="+">0</p><p class="hero-stat__label">EXPORT MARKETS</p></div>
    </div>
  </div>
</section>

<!-- ============================================================
     OUR STORY
     ============================================================ -->
<section class="section" id="story">
  <div class="container split">
    <div class="split__text">
      <p class="eyebrow" data-reveal>OUR STORY</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Built on Innovation,<br>Driven by Demand</h2>
      <span class="rule-red" data-reveal data-reveal-delay="120"></span>

      <p class="lead" data-reveal data-reveal-delay="160">
        HANIU was founded with a singular vision: to create electric vehicles that meet the
        real-world demands of global markets. Headquartered in Wuqing District, Tianjin -- China's
        industrial heartland -- we have grown from a regional manufacturer into a recognized
        international EV brand.
      </p>
      <p class="lead" data-reveal data-reveal-delay="200">
        Our growth is rooted in an unwavering commitment to quality, speed of innovation, and the
        ability to scale. We operate multiple production bases across Tianjin, Shandong, and Wuxi,
        giving us unmatched flexibility to serve large-volume OEM orders and bespoke distributor
        requirements simultaneously.
      </p>
      <p class="lead" data-reveal data-reveal-delay="240">
        Today, HANIU products are trusted by distributors, wholesalers, and importers in over 11
        countries -- a testament to our engineering excellence and after-sales reliability.
      </p>

      <ul class="cred-chips" data-reveal data-reveal-delay="280">
        <li>ISO9001:2005 Certified</li>
        <li>EEC &amp; COC Approved</li>
        <li>WMI World Factory</li>
        <li>CCC Certified</li>
      </ul>
    </div>

    <div class="split__visual" data-reveal data-reveal-delay="160">
      <span class="deco-fill"></span>
      <div class="collage">
        <div class="collage__col">
          <div class="media media--zoom collage__a" data-label="HQ building"><img src="assets/images/story-hq.jpg" alt="HANIU headquarters building"></div>
          <div class="media media--zoom collage__c" data-label="Frame welding"><img src="assets/images/story-welding.jpg" alt="Welder working on a vehicle frame"></div>
          <span class="deco-outline"></span>
        </div>
        <div class="collage__col collage__col--drop">
          <div class="media media--zoom collage__b" data-label="Design desk"><img src="assets/images/story-design.jpg" alt="Engineer sketching a vehicle design"></div>
          <div class="media media--zoom collage__d" data-label="Electronics"><img src="assets/images/story-electronics.jpg" alt="EV controller circuit board"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     HEADQUARTERS & PRODUCTION NETWORK
     ============================================================ -->
<section class="section section--dark" id="footprint">
  <div class="grid-texture"></div>
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal>OUR FOOTPRINT</p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">Headquarters &amp; Production Network</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub sec-head__sub--light" data-reveal data-reveal-delay="160">
        Strategically located manufacturing bases across three Chinese provinces, enabling efficient
        production and logistics for global export.
      </p>
    </header>

    <div class="hq-grid">
      <article class="hq" data-reveal>
        <svg class="hq__ghost"><use href="#i-pin"/></svg>
        <span class="hq__icon"><svg><use href="#i-building"/></svg></span>
        <p class="hq__kicker">GLOBAL HEADQUARTERS</p>
        <h3 class="hq__title">Tianjin Wuqing</h3>
        <p class="hq__text">
          Our main campus in Wuqing District, Tianjin spans over 200,000 m² and serves as the nerve
          center for R&amp;D, management, and primary manufacturing operations.
        </p>
        <div class="hq__stats">
          <div><p class="hq__num" data-count="200" data-suffix="K+">0</p><p class="hq__label">SQ.M AREA</p></div>
          <div><p class="hq__num" data-count="4">0</p><p class="hq__label">TIANJIN BASES</p></div>
        </div>
      </article>

      <article class="base-card base-card--a" data-reveal data-reveal-delay="90">
        <span class="base-card__icon"><svg><use href="#i-warehouse"/></svg></span>
        <h3 class="base-card__title">Tianjin Base 1-4</h3>
        <p class="base-card__text">Four dedicated production facilities in Tianjin covering high-volume assembly, frame welding, and component manufacturing.</p>
        <p class="base-card__tag">PRIMARY PRODUCTION HUB</p>
      </article>

      <article class="base-card base-card--b" data-reveal data-reveal-delay="180">
        <span class="base-card__icon"><svg><use href="#i-warehouse"/></svg></span>
        <h3 class="base-card__title">Shandong Base</h3>
        <p class="base-card__text">Strategically positioned in Shandong Province for expanded capacity, specialized component production, and coastal export logistics.</p>
        <p class="base-card__tag">COASTAL EXPORT ADVANTAGE</p>
      </article>

      <article class="base-card base-card--wide" data-reveal data-reveal-delay="270">
        <span class="base-card__icon"><svg><use href="#i-warehouse"/></svg></span>
        <h3 class="base-card__title">Wuxi Base</h3>
        <p class="base-card__text">Located in the heart of the Yangtze River Delta -- China's most advanced manufacturing corridor -- our Wuxi facility specializes in precision electronics, motor systems, and high-tech component integration.</p>
        <p class="base-card__tag">ADVANCED ELECTRONICS &amp; MOTOR SYSTEMS</p>
      </article>
    </div>
  </div>
</section>

<!-- ============================================================
     DOMESTIC STRENGTH
     ============================================================ -->
<section class="section section--alt">
  <div class="container split">
    <div class="split__visual" data-reveal>
      <span class="deco-outline deco-outline--br"></span>
      <div class="shot">
        <div class="media media--3x2 media--zoom" data-label="Retail store"><img src="assets/images/retail-store.jpg" alt="HANIU retail store interior"></div>
        <div class="shot__bar">
          <div><p class="shot__num" data-count="500" data-suffix="+">0</p><p class="shot__label">STORES NATIONWIDE</p></div>
          <div><p class="shot__num" data-count="30" data-suffix="+">0</p><p class="shot__label">PROVINCES COVERED</p></div>
          <div><p class="shot__num">#1</p><p class="shot__label">BRAND RECOGNITION</p></div>
        </div>
      </div>
    </div>

    <div class="split__text">
      <p class="eyebrow" data-reveal>DOMESTIC STRENGTH</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">500+ Offline Stores<br>Across China</h2>
      <span class="rule-red" data-reveal data-reveal-delay="120"></span>

      <p class="lead" data-reveal data-reveal-delay="160">
        HANIU's extensive offline retail network across China is a powerful proof of our brand
        credibility and product quality. With over 500 physical stores spanning 30+ provinces, we
        have built deep consumer trust that few manufacturers can match.
      </p>
      <p class="lead" data-reveal data-reveal-delay="200">
        This domestic success provides our international partners with confidence: when you choose
        HANIU, you're partnering with a brand that has proven itself in the world's most competitive
        EV market -- China itself.
      </p>

      <div class="checkrows">
        <div class="checkrow" data-reveal data-reveal-delay="240"><svg><use href="#i-check-circle"/></svg><p>Proven brand recognition in China's competitive EV market</p></div>
        <div class="checkrow" data-reveal data-reveal-delay="290"><svg><use href="#i-check-circle"/></svg><p>Standardized retail experience &amp; after-sales service network</p></div>
        <div class="checkrow" data-reveal data-reveal-delay="340"><svg><use href="#i-check-circle"/></svg><p>Real-world product validation from millions of domestic customers</p></div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     FACTORY SCALE & TEAM
     ============================================================ -->
<section class="section" id="team">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal>SCALE &amp; PEOPLE</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Factory Scale &amp; Our Team</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Behind every HANIU vehicle is a world-class facility and a dedicated team of skilled
        professionals committed to quality at every step.
      </p>
    </header>

    <div class="scale-grid">
      <div class="scale" data-reveal data-reveal-delay="0">
        <span class="scale__icon"><svg><use href="#i-building"/></svg></span>
        <p class="scale__num" data-count="200" data-suffix="K+">0</p>
        <p class="scale__label">M² TOTAL AREA</p>
      </div>
      <div class="scale" data-reveal data-reveal-delay="80">
        <span class="scale__icon"><svg><use href="#i-users"/></svg></span>
        <p class="scale__num" data-count="500" data-suffix="+">0</p>
        <p class="scale__label">SKILLED EMPLOYEES</p>
      </div>
      <div class="scale" data-reveal data-reveal-delay="160">
        <span class="scale__icon"><svg><use href="#i-warehouse"/></svg></span>
        <p class="scale__num" data-count="6">0</p>
        <p class="scale__label">PRODUCTION BASES</p>
      </div>
      <div class="scale" data-reveal data-reveal-delay="240">
        <span class="scale__icon"><svg><use href="#i-check-badge"/></svg></span>
        <p class="scale__num" data-count="5">0</p>
        <p class="scale__label">INT'L CERTIFICATIONS</p>
      </div>
    </div>

    <div class="banner" data-reveal>
      <div class="media media--fill media--zoom" data-label="Team on site"><img src="assets/images/team-banner.jpg" alt="HANIU production team at the Tianjin facility"></div>
      <div class="banner__scrim"></div>
      <div class="banner__body">
        <h3 class="banner__title">People Power Our Production</h3>
        <p class="banner__text">
          Our 500+ strong workforce includes experienced engineers, precision technicians, quality
          inspectors, and dedicated assembly specialists -- all working in concert to deliver
          vehicles that exceed global standards.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     CORE WORKSHOP CAPABILITIES
     ============================================================ -->
<section class="section section--alt" id="workshops">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal>IN-HOUSE MANUFACTURING</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Core Workshop Capabilities</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Full vertical integration across five specialized workshops ensures quality control at every
        stage and the flexibility to customize for any market requirement.
      </p>
    </header>

    <div class="shop-grid">
      <article class="shop" data-reveal data-reveal-delay="0">
        <span class="shop__icon"><svg><use href="#i-flask"/></svg></span>
        <h3 class="shop__title">Frame Welding Workshop</h3>
        <p class="shop__text">Precision robotic and manual welding lines for high-strength vehicle frames. Strict dimensional tolerances ensure structural integrity and consistent quality across all models.</p>
      </article>
      <article class="shop" data-reveal data-reveal-delay="80">
        <span class="shop__icon"><svg><use href="#i-spray"/></svg></span>
        <h3 class="shop__title">Baking Paint Workshop</h3>
        <p class="shop__text">State-of-the-art electrostatic spray painting and high-temperature baking ovens deliver uniform, durable, corrosion-resistant finishes in any custom color specification.</p>
      </article>
      <article class="shop" data-reveal data-reveal-delay="160">
        <span class="shop__icon"><svg><use href="#i-cylinder"/></svg></span>
        <h3 class="shop__title">Injection Molding Workshop</h3>
        <p class="shop__text">High-tonnage injection molding machines produce precise plastic body panels, covers, and components. In-house tooling capability enables rapid design iteration for OEM clients.</p>
      </article>
      <article class="shop" data-reveal data-reveal-delay="0">
        <span class="shop__icon"><svg><use href="#i-bolt"/></svg></span>
        <h3 class="shop__title">Motor Assembly Workshop</h3>
        <p class="shop__text">Dedicated motor winding, assembly, and testing lines for hub motors and mid-drive systems. Every motor undergoes performance testing before vehicle integration.</p>
      </article>
      <article class="shop" data-reveal data-reveal-delay="80">
        <span class="shop__icon"><svg><use href="#i-table"/></svg></span>
        <h3 class="shop__title">Wiring Harness Workshop</h3>
        <p class="shop__text">Custom wiring harness design and manufacturing for all vehicle models. Full electrical testing protocols ensure safety compliance for international certification standards.</p>
      </article>
      <article class="shop shop--dark" data-reveal data-reveal-delay="160">
        <span class="shop__icon"><svg><use href="#i-check-circle"/></svg></span>
        <h3 class="shop__title">End-of-Line Quality Control</h3>
        <p class="shop__text">100% final inspection for every vehicle including road simulation, brake testing, electrical diagnostics, and cosmetic review before shipment approval.</p>
        <p class="shop__tag">ISO9001:2005 COMPLIANT</p>
      </article>
    </div>
  </div>
</section>

<!-- ============================================================
     R&D CENTER
     ============================================================ -->
<section class="section section--dark" id="rd">
  <div class="grid-texture"></div>
  <div class="container split split--wide">
    <div class="split__text">
      <p class="eyebrow" data-reveal>INNOVATION ENGINE</p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">R&amp;D Center:<br>Where the Future is Built</h2>
      <span class="rule-red" data-reveal data-reveal-delay="120"></span>

      <p class="lead lead--light" data-reveal data-reveal-delay="160">
        Our dedicated Research &amp; Development Center is the creative and technical backbone of
        HANIU. A team of experienced engineers and designers continuously work on next-generation EV
        platforms, battery management systems, and smart connectivity features.
      </p>
      <p class="lead lead--light" data-reveal data-reveal-delay="200">
        Rapid prototyping capabilities allow us to move from concept to production-ready design
        faster than any competitor -- a critical advantage for OEM clients who need custom solutions
        on tight timelines.
      </p>

      <div class="rd-tiles">
        <div class="rd-tile" data-reveal data-reveal-delay="240"><h3>Fast</h3><p>Concept-to-Production Pipeline</p></div>
        <div class="rd-tile" data-reveal data-reveal-delay="290"><h3>Custom</h3><p>OEM/ODM Design Services</p></div>
        <div class="rd-tile" data-reveal data-reveal-delay="340"><h3>Smart</h3><p>IoT &amp; Connectivity R&amp;D</p></div>
        <div class="rd-tile" data-reveal data-reveal-delay="390"><h3>Green</h3><p>Battery &amp; Energy Efficiency</p></div>
      </div>
    </div>

    <div class="split__visual" data-reveal data-reveal-delay="160">
      <div class="media media--4x3 media--zoom" data-label="R&amp;D lab"><img src="assets/images/rd-lab.jpg" alt="EV controller board under development"></div>
      <div class="float-card">
        <p class="float-card__kicker"><i></i>ACTIVE R&amp;D PROJECTS</p>
        <h3 class="float-card__title">New Models</h3>
        <p class="float-card__text">Launching every product cycle to stay ahead of market trends</p>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     EXPORT EXPERIENCE
     ============================================================ -->
<section class="section" id="export">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal>GLOBAL REACH</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Export Experience &amp; Service Capability</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        From first inquiry to after-sales support, HANIU delivers a seamless international trade
        experience backed by years of export expertise.
      </p>
    </header>

    <div class="export">
      <div class="export__list">
        <article class="xfeat" data-reveal data-reveal-delay="0">
          <span class="xfeat__icon"><svg><use href="#i-globe"/></svg></span>
          <div>
            <h3 class="xfeat__title">11+ Active Export Markets</h3>
            <p class="xfeat__text">Established distribution relationships across Europe, South America, Southeast Asia, and CIS countries. We understand local regulations, certification requirements, and consumer preferences in each market.</p>
          </div>
        </article>
        <article class="xfeat" data-reveal data-reveal-delay="80">
          <span class="xfeat__icon"><svg><use href="#i-box"/></svg></span>
          <div>
            <h3 class="xfeat__title">Full-Service Logistics Support</h3>
            <p class="xfeat__text">We handle FCL/LCL container loading, export documentation, customs clearance coordination, and provide detailed packing lists and technical files required for import in destination countries.</p>
          </div>
        </article>
        <article class="xfeat" data-reveal data-reveal-delay="160">
          <span class="xfeat__icon"><svg><use href="#i-lifebuoy"/></svg></span>
          <div>
            <h3 class="xfeat__title">Dedicated After-Sales Service</h3>
            <p class="xfeat__text">Comprehensive after-sales support including spare parts inventory, technical documentation in multiple languages, remote troubleshooting, and on-site training programs for distributor technicians.</p>
          </div>
        </article>
        <article class="xfeat" data-reveal data-reveal-delay="240">
          <span class="xfeat__icon"><svg><use href="#i-shield"/></svg></span>
          <div>
            <h3 class="xfeat__title">Multi-Platform Trade Presence</h3>
            <p class="xfeat__text">Active on Alibaba, Made-in-China, and present at major international trade shows. Our digital presence spans LinkedIn, Facebook, Instagram, TikTok, and YouTube for maximum market reach.</p>
          </div>
        </article>
      </div>

      <aside class="export__side">
        <div class="dest" data-reveal data-reveal-delay="80">
          <h3 class="dest__title">Export Destinations</h3>
          <ul class="dest__list">
            <li><b>TR</b>Turkey</li><li><b>RO</b>Romania</li><li><b>LT</b>Lithuania</li>
            <li><b>BG</b>Bulgaria</li><li><b>RS</b>Serbia</li><li><b>CO</b>Colombia</li>
            <li><b>BR</b>Brazil</li><li><b>PE</b>Peru</li><li><b>MM</b>Myanmar</li>
            <li><b>RU</b>Russia</li><li><b>UA</b>Ukraine</li>
          </ul>
        </div>

        <div class="certcard" data-reveal data-reveal-delay="160">
          <h3 class="certcard__title">Certifications</h3>
          <ul class="certcard__list">
            <li><svg><use href="#i-check-circle"/></svg>ISO9001:2005</li>
            <li><svg><use href="#i-check-circle"/></svg>EEC European Certification</li>
            <li><svg><use href="#i-check-circle"/></svg>COC Certificate of Conformity</li>
            <li><svg><use href="#i-check-circle"/></svg>WMI World Factory Verified</li>
            <li><svg><use href="#i-check-circle"/></svg>CCC China Compulsory Cert.</li>
          </ul>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ============================================================
     COMPETITIVE EDGE
     ============================================================ -->
<section class="section section--alt">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal>WHY HANIU</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">The HANIU Competitive Edge</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        When choosing an EV manufacturing partner, the differences matter. Here's why leading
        distributors worldwide choose HANIU.
      </p>
    </header>

    <div class="edge-grid">
      <article class="edge edge--dark" data-reveal data-reveal-delay="0">
        <span class="edge__no">01</span>
        <span class="edge__icon"><svg><use href="#i-list"/></svg></span>
        <h3 class="edge__title">Full Product Range</h3>
        <p class="edge__text">E-tricycles, e-bicycles, e-motorcycles, and four-wheelers -- all under one roof. No need to source from multiple suppliers. One partner, complete portfolio.</p>
      </article>
      <article class="edge edge--top" data-reveal data-reveal-delay="80">
        <span class="edge__no">02</span>
        <span class="edge__icon"><svg><use href="#i-bolt"/></svg></span>
        <h3 class="edge__title">Rapid Product Updates</h3>
        <p class="edge__text">Our in-house R&amp;D center continuously develops new models and updates existing lines. Your catalog stays fresh and competitive in fast-moving markets.</p>
      </article>
      <article class="edge edge--red" data-reveal data-reveal-delay="160">
        <span class="edge__no">03</span>
        <span class="edge__icon"><svg><use href="#i-building"/></svg></span>
        <h3 class="edge__title">Mass Production Capacity</h3>
        <p class="edge__text">200,000 m² of factory space across 6 bases means we can fulfill large-volume orders without compromising lead times or quality. Scale is our strength.</p>
      </article>
      <article class="edge" data-reveal data-reveal-delay="0">
        <span class="edge__no">04</span>
        <span class="edge__icon"><svg><use href="#i-check-badge"/></svg></span>
        <h3 class="edge__title">Internationally Certified</h3>
        <p class="edge__text">EEC, COC, WMI, CCC, and ISO9001 certifications remove barriers to entry in your market. We've done the compliance work so you don't have to.</p>
      </article>
      <article class="edge edge--navy" data-reveal data-reveal-delay="80">
        <span class="edge__no">05</span>
        <span class="edge__icon"><svg><use href="#i-dollar"/></svg></span>
        <h3 class="edge__title">Competitive Factory Pricing</h3>
        <p class="edge__text">Direct factory pricing with no middleman markup. Our scale enables cost efficiencies that translate directly into better margins for our distribution partners.</p>
      </article>
      <article class="edge" data-reveal data-reveal-delay="160">
        <span class="edge__no">06</span>
        <span class="edge__icon"><svg><use href="#i-lifebuoy"/></svg></span>
        <h3 class="edge__title">Reliable After-Sales Support</h3>
        <p class="edge__text">Dedicated after-sales teams, multilingual technical documentation, fast spare parts supply, and on-site training ensure your end customers stay satisfied long after purchase.</p>
      </article>
    </div>
  </div>
</section>

<!-- ============================================================
     PARTNER WITH US
     ============================================================ -->
<section class="section section--dark" id="inquiry">
  <div class="grid-texture"></div>
  <div class="container partner">
    <div class="partner__text">
      <p class="eyebrow" data-reveal>PARTNER WITH US</p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">Ready to Build<br>Your EV Business?</h2>
      <span class="rule-red" data-reveal data-reveal-delay="120"></span>

      <p class="lead lead--light" data-reveal data-reveal-delay="160">
        Whether you're a distributor seeking a reliable supply partner, a wholesaler looking for
        competitive pricing, or an OEM client with custom requirements -- HANIU has the capacity,
        certifications, and commitment to deliver.
      </p>

      <ul class="contact-rows">
        <li data-reveal data-reveal-delay="200">
          <span class="contact-rows__icon"><svg><use href="#i-mail"/></svg></span>
          <div><p class="contact-rows__label">EMAIL US</p><a class="contact-rows__value" href="mailto:export@haniu.com">export@haniu.com</a></div>
        </li>
        <li data-reveal data-reveal-delay="250">
          <span class="contact-rows__icon"><svg><use href="#i-pin"/></svg></span>
          <div><p class="contact-rows__label">HEADQUARTERS</p><p class="contact-rows__value">Wuqing District, Tianjin, China</p></div>
        </li>
        <li data-reveal data-reveal-delay="300">
          <span class="contact-rows__icon"><svg><use href="#i-globe"/></svg></span>
          <div><p class="contact-rows__label">TRADE PLATFORMS</p><p class="contact-rows__value">Alibaba · Made-in-China · Global Shows</p></div>
        </li>
      </ul>

      <div class="partner__actions" data-reveal data-reveal-delay="350">
        <a class="btn btn--red" href="#inquiry">Request Product Catalog <svg><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>

    <div class="msg-card" data-reveal data-reveal-delay="140">
      <h3 class="msg-card__title">Send Us a Message</h3>

      <form id="inquiryForm" method="post">
        <?php $dark = true; require __DIR__ . '/includes/inquiry-fields.php'; ?>
      </form>
    </div>
  </div>
</section>

<?php
$ctaHref = '#inquiry';
require __DIR__ . '/includes/footer.php';
