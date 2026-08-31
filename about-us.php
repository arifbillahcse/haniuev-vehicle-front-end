<?php
require __DIR__ . '/config.php';
require __DIR__ . '/includes/inquiry-handler.php';

$pageTitle = 'About | HANIU Electric Tricycles & Ebicycles Factory in China';
$pageDescription = 'HANIU is the electric vehicle brand of Tianjin Xingchang Electric Vehicle Co., Ltd. — 200,000 m² of integrated EV manufacturing across 15 workshops, exporting to 60+ countries.';
$activeNav = 'about';
$extraCss = ['about.css'];
require __DIR__ . '/includes/header.php';
?>

<!-- ============================================================
     01 — HERO
     ============================================================ -->
<section class="page-hero">
  <div class="page-hero__bg" id="heroBg">
    <div class="media media--fill" data-label="Factory exterior / aerial view">
      <img src="assets/images/hq-aerial.jpg" alt="Aerial view of the HANIU production base">
    </div>
  </div>
  <div class="page-hero__scrim"></div>
  <div class="grid-texture"></div>

  <div class="container page-hero__inner">
    <span class="pill" data-reveal><i></i>ABOUT HANIU</span>
    <h1 class="page-hero__title">
      <span data-reveal data-reveal-delay="80">Engineering Electric Mobility.</span>
      <span data-reveal data-reveal-delay="160">Building Trust Worldwide.</span>
    </h1>
    <p class="page-hero__lead" data-reveal data-reveal-delay="240">
      HANIU is the electric vehicle brand of Tianjin Xingchang Electric Vehicle Co., Ltd., combining
      product development, component manufacturing, vehicle assembly, and OEM/ODM capabilities to
      deliver electric mobility solutions to global markets.
    </p>

    <div class="hero__actions" data-reveal data-reveal-delay="320">
      <a class="btn btn--red" href="#factory">Explore Our Factory <svg><use href="#i-arrow-right"/></svg></a>
      <a class="btn btn--ghost" href="assets/catalogs/haniu-catalogue.pdf" download>Download Catalogue <svg><use href="#i-download"/></svg></a>
    </div>
  </div>
</section>

<!-- ============================================================
     02 — WHO WE ARE
     ============================================================ -->
<section class="section" id="who-we-are">
  <div class="container split">
    <div class="split__text">
      <p class="eyebrow" data-reveal>WHO WE ARE</p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Built on Quality.<br>Driven by Innovation.</h2>
      <span class="rule-red" data-reveal data-reveal-delay="120"></span>

      <p class="lead" data-reveal data-reveal-delay="160">
        Founded in March 2021, Tianjin Xingchang Electric Vehicle Co., Ltd. has built its development
        around quality, manufacturing capability, and continuous innovation. HANIU is our own electric
        vehicle brand, while our manufacturing capabilities also support OEM and ODM partnerships for
        international brands.
      </p>

      <div class="stat-row" data-reveal data-reveal-delay="200">
        <div class="stat-row__item">
          <p class="stat-row__num" data-count="2021">0</p>
          <p class="stat-row__label">Founded</p>
        </div>
        <div class="stat-row__item">
          <p class="stat-row__num" data-count="200" data-suffix="K m²">0</p>
          <p class="stat-row__label">Production Base</p>
        </div>
        <div class="stat-row__item">
          <p class="stat-row__num" data-count="15">0</p>
          <p class="stat-row__label">Professional Workshops</p>
        </div>
        <div class="stat-row__item">
          <p class="stat-row__num" data-count="60" data-suffix="+">0</p>
          <p class="stat-row__label">Countries &amp; Regions</p>
        </div>
      </div>
    </div>

    <div class="split__visual" data-reveal data-reveal-delay="160">
      <div class="media-cluster">
        <div class="media media--zoom media-cluster__main" data-label="Company / factory photo — main">
          <img src="assets/images/factory-full.png" alt="HANIU production base overview">
        </div>
        <div class="media media--zoom media-cluster__sub" data-label="Company photo — secondary">
          <img src="assets/images/factory-floor.jpg" alt="Inside the HANIU factory floor">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     03 — OUR FACTORY
     ============================================================ -->
<section class="section section--alt" id="factory">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>OUR FACTORY<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">200,000 m² of Integrated EV Manufacturing</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Our production base integrates multiple specialized workshops covering core components,
        vehicle structures, surface treatment, injection molding, electric bicycles, tricycles, and
        final vehicle assembly. This integrated manufacturing environment allows us to maintain
        greater control over production quality, consistency, and efficiency.
      </p>
    </header>

    <div class="mosaic" data-reveal data-reveal-delay="120">
      <div class="media mosaic__item" data-label="Factory exterior"><img src="assets/images/factory-images/factory-exterior.jpg" alt="HANIU factory exterior"></div>
      <div class="media mosaic__item" data-label="Production building"><img src="assets/images/factory-images/factory-production-building.jpg" alt="Production building"></div>
      <div class="media mosaic__item" data-label="Workshop overview"><img src="assets/images/factory-images/factory-workshop-overview.jpg" alt="Workshop overview"></div>
      <div class="media mosaic__item" data-label="Machinery"><img src="assets/images/factory-images/factory-machinery.jpg" alt="Production machinery"></div>
      <div class="media mosaic__item" data-label="Workers / production"><img src="assets/images/factory-images/factory-workers.jpg" alt="Workers on the production line"></div>
      <div class="media mosaic__item" data-label="Finished vehicles"><img src="assets/images/factory-images/factory-finished-vehicles.jpg" alt="Finished HANIU vehicles"></div>
      <div class="media mosaic__item" data-label="Factory complex"><img src="assets/images/factory-images/factory-extra-1.jpg" alt="HANIU factory complex"></div>
      <div class="media mosaic__item" data-label="Factory complex"><img src="assets/images/factory-images/factory-extra-2.jpg" alt="HANIU factory complex"></div>
    </div>
  </div>
</section>

<!-- ============================================================
     04 — MOTOR WORKSHOP
     ============================================================ -->
<section class="section" id="motor-workshop">
  <div class="container">
    <div class="sec-head--row">
      <div>
        <p class="eyebrow" data-reveal>MOTOR WORKSHOP</p>
        <h2 class="h2" data-reveal data-reveal-delay="80">Power Starts at the Core</h2>
      </div>
      <p class="lead" data-reveal data-reveal-delay="120">
        Our motor workshop combines automated winding, magnet bonding, core assembly, and precision
        processing equipment to support the development and production of permanent magnet
        synchronous motors across different EV applications. From compact motors to higher-output
        systems, every power unit is developed with efficiency, consistency, and reliability in mind.
      </p>
    </div>

    <div class="workshop__gallery" data-reveal data-reveal-delay="160">
      <div class="media" data-label="Workshop overview"><img src="assets/images/factory-images/motor-workshop-overview.jpg" alt="Motor workshop overview"></div>
      <div class="media" data-label="Automatic winding machine"><img src="assets/images/factory-images/motor-winding-machine.png" alt="Automatic winding machine"></div>
      <div class="media" data-label="Magnet bonding machine"><img src="assets/images/factory-images/motor-magnet-bonding.jpg" alt="Magnet bonding machine"></div>
      <div class="media" data-label="Motor assembly"><img src="assets/images/factory-images/motor-assembly.png" alt="Motor assembly"></div>
      <div class="media" data-label="Motor components"><img src="assets/images/factory-images/motor-components.png" alt="Motor components"></div>
      <div class="media" data-label="Finished motor"><img src="assets/images/factory-images/motor-finished.jpg" alt="Finished motor"></div>
    </div>

    <ul class="chip-row">
      <li class="tag tag--navy">AUTOMATED WINDING</li>
      <li class="tag tag--navy">PRECISION ASSEMBLY</li>
      <li class="tag tag--navy">MOTOR DEVELOPMENT</li>
      <li class="tag tag--navy">QUALITY INSPECTION</li>
    </ul>
  </div>
</section>

<!-- ============================================================
     05 — WIRING HARNESS WORKSHOP
     ============================================================ -->
<section class="section section--alt" id="harness-workshop">
  <div class="container">
    <div class="sec-head--row">
      <div>
        <p class="eyebrow" data-reveal>WIRING HARNESS WORKSHOP</p>
        <h2 class="h2" data-reveal data-reveal-delay="80">Precision Behind Every Connection</h2>
      </div>
      <p class="lead" data-reveal data-reveal-delay="120">
        Reliable electric mobility depends on reliable electrical connections. Our wiring harness
        workshop uses professional terminal crimping, automatic crimping, wire cutting, and testing
        equipment to produce consistent harnesses for different electric vehicle applications.
      </p>
    </div>

    <div class="workshop__gallery" data-reveal data-reveal-delay="160">
      <div class="media" data-label="Workshop overview"><img src="assets/images/factory-images/harness-workshop-overview.jpg" alt="Wiring harness workshop overview"></div>
      <div class="media" data-label="Terminal crimping"><img src="assets/images/factory-images/harness-terminal-crimping.jpg" alt="Terminal crimping"></div>
      <div class="media" data-label="Automatic crimping"><img src="assets/images/factory-images/harness-automatic-crimping.jpg" alt="Automatic crimping"></div>
      <div class="media" data-label="Wire cutting"><img src="assets/images/factory-images/harness-wire-cutting.jpg" alt="Wire cutting"></div>
      <div class="media" data-label="Testing equipment"><img src="assets/images/factory-images/harness-testing.jpg" alt="Testing equipment"></div>
      <div class="media" data-label="Finished harness"><img src="assets/images/factory-images/harness-finished.jpg" alt="Finished wiring harness"></div>
    </div>

    <ul class="chip-row">
      <li class="tag tag--navy">PRECISION CRIMPING</li>
      <li class="tag tag--navy">AUTOMATED PROCESSING</li>
      <li class="tag tag--navy">ELECTRICAL TESTING</li>
    </ul>
  </div>
</section>

<!-- ============================================================
     06 — FRAME & STAMPING WORKSHOP
     ============================================================ -->
<section class="section" id="frame-workshop">
  <div class="container">
    <div class="sec-head--row">
      <div>
        <p class="eyebrow" data-reveal>FRAME &amp; STAMPING WORKSHOP</p>
        <h2 class="h2" data-reveal data-reveal-delay="80">Engineered for Strength. Tested for Confidence.</h2>
      </div>
      <p class="lead" data-reveal data-reveal-delay="120">
        Vehicle safety begins with the structure. Our frame and body production processes combine
        professional engineering calculations with laser cutting, CNC pipe bending, stamping, and
        precision fabrication. Finished frames undergo rigorous vibration testing to help verify
        structural strength and reliability.
      </p>
    </div>

    <div class="workshop__gallery" data-reveal data-reveal-delay="160">
      <div class="media" data-label="Laser cutting"><img src="assets/images/factory-images/frame-laser-cutting.jpg" alt="Laser cutting"></div>
      <div class="media" data-label="CNC pipe bending"><img src="assets/images/factory-images/frame-cnc-bending.jpg" alt="CNC pipe bending"></div>
      <div class="media" data-label="Stamping machine"><img src="assets/images/factory-images/frame-stamping.jpg" alt="Stamping machine"></div>
      <div class="media" data-label="Welding / fabrication"><img src="assets/images/factory-images/frame-welding-1.jpg" alt="Robotic welding of vehicle frames"></div>
      <div class="media" data-label="Frame assembly"><img src="assets/images/factory-images/frame-welding-2.jpg" alt="Frame welding cell"></div>
      <div class="media" data-label="Vibration testing"><img src="assets/images/factory-images/frame-vibration-testing.jpg" alt="Vibration testing"></div>
      <div class="media" data-label="Robotic welding"><img src="assets/images/factory-images/frame-welding-extra.png" alt="Robotic welding arm"></div>
    </div>

    <ol class="flow-line" id="frameFlow">
      <li class="flow-line__step" data-reveal data-reveal-delay="0"><span>Design</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="60"><span>Cutting</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="120"><span>Bending</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="180"><span>Stamping</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="240"><span>Welding</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="300"><span>Testing</span></li>
    </ol>
  </div>
</section>

<!-- ============================================================
     07 — PAINTING & SURFACE TREATMENT
     ============================================================ -->
<section class="section section--dark" id="painting">
  <div class="grid-texture"></div>
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow--light eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>PAINTING &amp; SURFACE TREATMENT<span class="eyebrow__rule"></span></p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">Protection Beneath the Surface</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub sec-head__sub--light" data-reveal data-reveal-delay="160">
        Our painting process combines multiple surface-treatment stages, including pickling,
        phosphating, electrophoresis, and a 3-coat/3-bake finishing process. The result is a durable
        surface designed to improve corrosion resistance while maintaining a refined and consistent
        appearance.
      </p>
    </header>

    <div class="workshop__gallery" data-reveal data-reveal-delay="200">
      <div class="media" data-label="Pre-treatment"><img src="assets/images/factory-images/paint-pretreatment.jpg" alt="Pre-treatment"></div>
      <div class="media" data-label="Phosphating"><img src="assets/images/factory-images/paint-phosphating.jpg" alt="Phosphating"></div>
      <div class="media" data-label="Electrophoresis"><img src="assets/images/factory-images/paint-electrophoresis.jpg" alt="Electrophoresis"></div>
      <div class="media" data-label="Painting"><img src="assets/images/factory-images/paint-shop-7.png" alt="Workers hand-spraying vehicle body panels"></div>
      <div class="media" data-label="Baking oven"><img src="assets/images/factory-images/paint-baking-oven.jpg" alt="Baking oven"></div>
      <div class="media" data-label="Finished body"><img src="assets/images/factory-images/paint-finished-body.jpg" alt="Finished body"></div>
      <div class="media" data-label="Paint inspection"><img src="assets/images/factory-images/paint-inspection.jpg" alt="Paint inspection"></div>
      <div class="media" data-label="Spray painting"><img src="assets/images/factory-images/paint-extra.png" alt="Workers spray painting vehicle parts"></div>
    </div>

    <ol class="flow-vertical center" id="paintFlow" style="margin:36px auto 0">
      <li data-reveal data-reveal-delay="0"><span>Pickling</span></li>
      <li data-reveal data-reveal-delay="60"><span>Phosphating</span></li>
      <li data-reveal data-reveal-delay="120"><span>Electrophoresis</span></li>
      <li data-reveal data-reveal-delay="180"><span>3-Coat / 3-Bake</span></li>
      <li data-reveal data-reveal-delay="240"><span>Final Finish</span></li>
    </ol>
  </div>
</section>

<!-- ============================================================
     08 — INJECTION MOLDING
     ============================================================ -->
<section class="section" id="injection-molding">
  <div class="container">
    <div class="sec-head--row">
      <div>
        <p class="eyebrow" data-reveal>INJECTION MOLDING</p>
        <h2 class="h2" data-reveal data-reveal-delay="80">Precision-Molded Components</h2>
      </div>
      <p class="lead" data-reveal data-reveal-delay="120">
        Our injection molding workshop supports the production of high-quality vehicle components
        through advanced molding equipment and standardized production processes. Combined with
        modern production management and MES systems, the workshop is designed to maintain
        consistency from raw material processing to finished components.
      </p>
    </div>

    <div class="workshop__gallery" data-reveal data-reveal-delay="160">
      <div class="media" data-label="Injection molding machines"><img src="assets/images/factory-images/molding-machines.jpg" alt="Injection molding machines"></div>
      <div class="media" data-label="Mold close-up"><img src="assets/images/factory-images/molding-mold-closeup.jpg" alt="Mold close-up"></div>
      <div class="media" data-label="Production process"><img src="assets/images/factory-images/molding-process.jpg" alt="Production process"></div>
      <div class="media" data-label="Molded components"><img src="assets/images/factory-images/molding-components.jpg" alt="Molded components"></div>
      <div class="media" data-label="Quality inspection"><img src="assets/images/factory-images/molding-inspection.jpg" alt="Quality inspection"></div>
      <div class="media" data-label="Workshop overview"><img src="assets/images/factory-images/molding-overview.jpg" alt="Injection molding workshop overview"></div>
      <div class="media" data-label="Injection molding"><img src="assets/images/factory-images/molding-extra-1.jpg" alt="Injection molding shop"></div>
      <div class="media" data-label="Injection molding"><img src="assets/images/factory-images/molding-extra-2.jpg" alt="Injection molding shop"></div>
      <div class="media" data-label="Injection molding"><img src="assets/images/factory-images/molding-extra-3.jpg" alt="Injection molding shop"></div>
      <div class="media" data-label="Injection molding"><img src="assets/images/factory-images/molding-extra-4.jpg" alt="Injection molding shop"></div>
      <div class="media" data-label="Injection molding"><img src="assets/images/factory-images/molding-extra-5.jpg" alt="Injection molding shop"></div>
      <div class="media" data-label="Injection molding"><img src="assets/images/factory-images/molding-extra-6.jpg" alt="Injection molding shop"></div>
    </div>

    <ul class="chip-row">
      <li class="tag tag--navy">ADVANCED EQUIPMENT</li>
      <li class="tag tag--navy">PRECISION MOLDS</li>
      <li class="tag tag--navy">CONSISTENT QUALITY</li>
      <li class="tag tag--navy">MES MANAGEMENT</li>
    </ul>
  </div>
</section>

<!-- ============================================================
     09 — eBIKE & TRICYCLE PRODUCTION
     ============================================================ -->
<section class="section section--alt" id="ebike-production">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>eBIKE &amp; TRICYCLE PRODUCTION<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">From Components to Complete Mobility</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Our specialized production lines support electric bicycles, electric tricycles, and other
        electric mobility products. Standardized processes and dedicated assembly teams bring
        together frames, electrical systems, motors, body components, and finishing details into
        complete vehicles.
      </p>
    </header>
  </div>

  <div class="hgallery" data-reveal data-reveal-delay="200">
    <div class="media media--zoom" data-label="eBike production"><img src="assets/images/factory-images/ebike-production.jpg" alt="eBike production"></div>
    <div class="media media--zoom" data-label="Tricycle production"><img src="assets/images/factory-images/tricycle-production.jpg" alt="Tricycle chassis and frame production"></div>
    <div class="media media--zoom" data-label="Workers assembling"><img src="assets/images/factory-images/workers-assembling.jpg" alt="Workers assembling"></div>
    <div class="media media--zoom" data-label="Electrical installation"><img src="assets/images/factory-images/electrical-installation.jpg" alt="Electrical installation"></div>
    <div class="media media--zoom" data-label="Body installation"><img src="assets/images/factory-images/body-installation.jpg" alt="Body installation"></div>
    <div class="media media--zoom" data-label="Product finishing"><img src="assets/images/factory-images/product-finishing.jpg" alt="Product finishing"></div>
    <div class="media media--zoom" data-label="eBike production"><img src="assets/images/factory-images/ebike-production-extra.jpg" alt="Finished eBikes ready for shipment"></div>
  </div>
</section>

<!-- ============================================================
     10 — FINAL ASSEMBLY
     ============================================================ -->
<section class="section" id="final-assembly">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>FINAL ASSEMBLY<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Every Detail Comes Together</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Final assembly is where every component becomes a complete vehicle. Standardized assembly
        procedures, dedicated production lines, and professional inspection equipment help maintain
        consistency across each vehicle before it leaves the factory.
      </p>
    </header>

    <div class="mosaic" data-reveal data-reveal-delay="200">
      <div class="media mosaic__item" data-label="Assembly line"><img src="assets/images/factory-images/assembly-line.jpg" alt="Assembly line"></div>
      <div class="media mosaic__item" data-label="Chassis assembly"><img src="assets/images/factory-images/chassis-assembly.jpg" alt="Chassis assembly"></div>
      <div class="media mosaic__item" data-label="Motor installation"><img src="assets/images/factory-images/motor-installation.jpg" alt="Motor installation"></div>
      <div class="media mosaic__item" data-label="Electrical installation"><img src="assets/images/factory-images/assembly-electrical.jpg" alt="Electrical installation"></div>
      <div class="media mosaic__item" data-label="Body installation"><img src="assets/images/factory-images/assembly-body.jpg" alt="Body installation"></div>
      <div class="media mosaic__item" data-label="Interior / seat installation"><img src="assets/images/factory-images/interior-installation.jpg" alt="Interior and seat installation"></div>
      <div class="media mosaic__item" data-label="Final inspection"><img src="assets/images/factory-images/final-inspection.jpg" alt="Final inspection"></div>
      <div class="media mosaic__item" data-label="Finished vehicle"><img src="assets/images/factory-images/factory-finished-vehicles.jpg" alt="Finished HANIU vehicles ready for shipment"></div>
      <div class="media mosaic__item" data-label="Warehouse"><img src="assets/images/factory-images/finished-vehicle-extra-1.jpg" alt="HANIU finished goods warehouse"></div>
      <div class="media mosaic__item" data-label="Warehouse"><img src="assets/images/factory-images/finished-vehicle-extra-2.jpg" alt="HANIU finished goods warehouse"></div>
    </div>

    <ol class="flow-line flow-line--long" id="assemblyFlow">
      <li class="flow-line__step" data-reveal data-reveal-delay="0"><span>Frame</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="50"><span>Power System</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="100"><span>Electrical</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="150"><span>Body</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="200"><span>Interior</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="250"><span>Inspection</span></li>
      <li class="flow-line__step" data-reveal data-reveal-delay="300"><span>Finished EV</span></li>
    </ol>
  </div>
</section>

<!-- ============================================================
     11 — TESTING & QUALITY CONTROL
     ============================================================ -->
<section class="section section--alt" id="quality-control">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>TESTING &amp; QUALITY CONTROL<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Quality Is Tested, Not Simply Claimed.</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Quality control extends throughout our production process, from individual components to
        complete vehicles. Professional testing equipment and inspection procedures help verify
        structural performance, suspension durability, corrosion resistance, electrical systems, and
        overall vehicle quality.
      </p>
    </header>

    <div class="qc-grid">
      <article class="qc-card" data-reveal data-reveal-delay="0">
        <div class="media media--3x2" data-label="Frame vibration test"><img src="assets/images/factory-images/qc-frame-vibration.jpg" alt="Frame vibration test"></div>
        <h3 class="qc-card__title">Frame Vibration Test</h3>
        <p class="qc-card__desc">Verifies structural strength under sustained mechanical stress.</p>
      </article>
      <article class="qc-card" data-reveal data-reveal-delay="80">
        <div class="media media--3x2" data-label="Shock absorber test"><img src="assets/images/factory-images/qc-shock-absorber.jpg" alt="Shock absorber test"></div>
        <h3 class="qc-card__title">Shock Absorber Test</h3>
        <p class="qc-card__desc">Confirms suspension durability across repeated load cycles.</p>
      </article>
      <article class="qc-card" data-reveal data-reveal-delay="160">
        <div class="media media--3x2" data-label="Salt spray test"><img src="assets/images/factory-images/qc-salt-spray.jpg" alt="Salt spray test"></div>
        <h3 class="qc-card__title">Salt Spray Test</h3>
        <p class="qc-card__desc">Assesses corrosion resistance of coated and treated surfaces.</p>
      </article>
      <article class="qc-card" data-reveal data-reveal-delay="0">
        <div class="media media--3x2" data-label="Electrical testing"><img src="assets/images/factory-images/qc-electrical.jpg" alt="Electrical testing"></div>
        <h3 class="qc-card__title">Electrical Testing</h3>
        <p class="qc-card__desc">Checks wiring, connections, and system performance.</p>
      </article>
      <article class="qc-card" data-reveal data-reveal-delay="80">
        <div class="media media--3x2" data-label="Component inspection"><img src="assets/images/factory-images/qc-component-inspection.jpg" alt="Component inspection"></div>
        <h3 class="qc-card__title">Component Inspection</h3>
        <p class="qc-card__desc">Reviews individual parts against production standards.</p>
      </article>
      <article class="qc-card" data-reveal data-reveal-delay="160">
        <div class="media media--3x2" data-label="Final vehicle inspection"><img src="assets/images/factory-images/qc-final-inspection.jpg" alt="Final vehicle inspection"></div>
        <h3 class="qc-card__title">Final Vehicle Inspection</h3>
        <p class="qc-card__desc">A complete review before each vehicle leaves the factory.</p>
      </article>
    </div>
  </div>
</section>

<!-- ============================================================
     12 — SMART MANUFACTURING
     ============================================================ -->
<section class="section" id="smart-manufacturing">
  <div class="container split split--media-first">
    <div class="split__visual" data-reveal>
      <div class="media-cluster">
        <div class="media media--zoom media-cluster__main" data-label="MES system / production monitoring">
          <img src="assets/images/factory-images/smart-mes-system.jpg" alt="MES production monitoring system">
        </div>
        <div class="media media--zoom media-cluster__sub" data-label="Automated machinery">
          <img src="assets/images/factory-images/smart-automated-machinery.jpg" alt="Automated production machinery">
        </div>
      </div>
    </div>
    <div class="split__text" data-reveal data-reveal-delay="120">
      <p class="eyebrow">SMART MANUFACTURING</p>
      <h2 class="h2">Technology Meets Manufacturing Discipline</h2>
      <span class="rule-red"></span>
      <p class="lead">
        By combining automated production equipment with modern management systems, Xingchang
        continues to improve manufacturing efficiency, process control, and product consistency.
      </p>
    </div>
  </div>
</section>

<!-- ============================================================
     13 — CERTIFICATION (dynamic, admin-managed)
     ============================================================ -->
<?php $certificates = db_all('SELECT * FROM certificates ORDER BY sort_order, id'); ?>
<?php if ($certificates): ?>
<section class="section section--alt" id="certification">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>CERTIFICATION<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Built for Global Markets</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        Our commitment to quality extends beyond the factory. Selected Xingchang Electric Vehicle
        products have successfully obtained EU certification, supporting our presence across
        international markets.
      </p>
    </header>

    <div class="cert-gallery">
      <?php foreach ($certificates as $i => $cert): ?>
        <button type="button" class="cert-gallery__item" data-reveal data-reveal-delay="<?= ($i % 4) * 80 ?>" data-full="assets/images/<?= h($cert['image']) ?>" data-name="<?= h($cert['name']) ?>">
          <img src="assets/images/<?= h($cert['image']) ?>" alt="<?= h($cert['name']) ?>">
          <span class="cert-gallery__name"><?= h($cert['name']) ?></span>
        </button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="cert-modal" id="certModal" hidden>
  <button type="button" class="cert-modal__close" id="certModalClose" aria-label="Close">&times;</button>
  <img class="cert-modal__img" id="certModalImg" src="" alt="">
  <p class="cert-modal__caption" id="certModalCaption"></p>
</div>
<?php endif; ?>

<!-- ============================================================
     14 — GLOBAL PRESENCE
     ============================================================ -->
<section class="section section--dark" id="global-presence">
  <div class="grid-texture"></div>
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow--light eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>GLOBAL PRESENCE<span class="eyebrow__rule"></span></p>
      <h2 class="h2 h2--light" data-reveal data-reveal-delay="80">From Tianjin to the World</h2>
      <p class="stat-row__num" data-count="60" data-suffix="+" style="text-align:center;margin:18px 0 0;color:#fff">0</p>
      <p class="sec-head__sub sec-head__sub--light" data-reveal data-reveal-delay="160">
        Today, Xingchang products reach more than 60 countries and regions, connecting our
        manufacturing capabilities with customers across Asia, Europe, the Middle East, Africa, and
        the Americas.
      </p>
    </header>

    <div class="world-map" data-reveal data-reveal-delay="120">
      <svg class="world-map__icon"><use href="#i-globe"/></svg>
    </div>

    <ul class="market-tags">
      <li class="tag">Uzbekistan</li>
      <li class="tag">Tajikistan</li>
      <li class="tag">Turkey</li>
      <li class="tag">Thailand</li>
      <li class="tag">Philippines</li>
      <li class="tag">Russia</li>
      <li class="tag">Canada</li>
      <li class="tag">UAE</li>
      <li class="tag">Peru</li>
      <li class="tag">Mexico</li>
      <li class="tag">Nigeria</li>
    </ul>
  </div>
</section>

<!-- ============================================================
     15 — OEM / ODM
     ============================================================ -->
<section class="section section--alt" id="oem-odm">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>OEM / ODM<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">Your Brand. Our Manufacturing Capability.</h2>
      <span class="sec-head__rule" data-reveal data-reveal-delay="120"></span>
      <p class="sec-head__sub" data-reveal data-reveal-delay="160">
        In addition to HANIU, Tianjin Xingchang Electric Vehicle Co., Ltd. provides OEM and ODM
        manufacturing support for selected international brands. From product development and
        customization to production and delivery, we help partners transform ideas into
        market-ready electric vehicles.
      </p>
    </header>

    <ol class="oem-flow" data-reveal data-reveal-delay="200">
      <li>Product Idea</li>
      <li>Engineering</li>
      <li>Prototype</li>
      <li>Production</li>
      <li>Quality Control</li>
      <li>Delivery</li>
    </ol>

    <div class="center" style="margin-top:44px">
      <a href="contact.php" class="btn btn--red">Start an OEM / ODM Project <svg><use href="#i-arrow-right"/></svg></a>
    </div>
  </div>
</section>

<!-- ============================================================
     16 — FACTORY VIDEO
     ============================================================ -->
<section class="section section--alt" id="factory-video">
  <div class="container">
    <header class="sec-head">
      <p class="eyebrow eyebrow--center" data-reveal><span class="eyebrow__rule"></span>FACTORY VIDEO<span class="eyebrow__rule"></span></p>
      <h2 class="h2" data-reveal data-reveal-delay="80">See How We Build Electric Mobility</h2>
      <p class="sec-head__sub" data-reveal data-reveal-delay="140">
        Step inside the HANIU production base and explore our workshops, manufacturing equipment,
        testing facilities, and vehicle assembly processes.
      </p>
    </header>

    <div class="video-embed" data-reveal data-reveal-delay="180">
      <iframe src="https://www.youtube.com/embed/k7AQHC5KlMY" title="HANIU factory tour" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
  </div>
</section>

<!-- ============================================================
     17 — CATALOGUE
     ============================================================ -->
<section class="section catalogue" id="catalogue">
  <div class="container split split--media-first">
    <div class="split__visual" data-reveal>
      <div class="media media--3x2" data-label="Catalogue cover"><img src="assets/images/factory-images/catalogue-cover.jpg" alt="HANIU EV catalogue cover"></div>
    </div>
    <div class="split__text" data-reveal data-reveal-delay="120">
      <p class="eyebrow">CATALOGUE</p>
      <h2 class="h2">Explore the HANIU EV Range</h2>
      <span class="rule-red"></span>
      <p class="lead">
        Discover our complete range of electric bicycles, electric tricycles, electric motorcycles,
        and four-wheelers.
      </p>
      <div class="hero__actions">
        <a href="assets/catalogs/haniu-catalogue.pdf" class="btn btn--red" download>Download Catalogue <svg><use href="#i-download"/></svg></a>
        <a href="index.php#portfolio" class="link-dark">View Products <svg><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     18 — FINAL STATEMENT
     ============================================================ -->
<section class="section section--dark final-statement">
  <div class="grid-texture"></div>
  <div class="container center">
    <h2 class="h2 h2--light final-statement__title">
      <span data-reveal>Driven by Technology.</span>
      <span data-reveal data-reveal-delay="80">Built on Quality.</span>
      <span class="is-red" data-reveal data-reveal-delay="160">Moving the World Forward.</span>
    </h2>
    <div class="final-statement__brand" data-reveal data-reveal-delay="240">
      <img src="assets/images/h-logo.jpeg" alt="HANIU" class="final-statement__logo">
      <p>An electric vehicle brand by Tianjin Xingchang Electric Vehicle Co., Ltd.</p>
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
          <div><p class="contact-rows__label">HEADQUARTERS</p><p class="contact-rows__value">Tianjin, China</p></div>
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
