-- HANIU EV — database schema + seed data (MySQL).
-- Applied automatically on first request against an empty database
-- (see config.php: db()).

CREATE TABLE admins (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default login: admin / ChangeMe123!
-- Change this immediately from the admin dashboard after first login.
INSERT INTO admins (username, password_hash) VALUES
    ('admin', '$2y$12$.Pb7X8uu8JeB5m7saB.a0OxnQipPmGOk222UcmCX/QMPuWxKsOo2i');

CREATE TABLE products (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    category    VARCHAR(50) NOT NULL,   -- tricycle | bicycle | motorcycle | four-wheeler | motor | controller
    name        VARCHAR(150) NOT NULL,  -- e.g. "HN-B200 Urban"
    slug        VARCHAR(190) NOT NULL UNIQUE,
    cat_label   VARCHAR(100) NOT NULL,  -- small kicker shown on the card, e.g. "E-BICYCLE"
    spec        VARCHAR(255) NOT NULL,  -- spec line, e.g. "500W Motor · 48V · 80km Range"
    badge_text  VARCHAR(50) NOT NULL DEFAULT '',
    badge_color VARCHAR(20) NOT NULL DEFAULT 'navy', -- red | navy | green | blue
    image       VARCHAR(255) NOT NULL DEFAULT '',    -- filename inside assets/images/
    featured    TINYINT(1) NOT NULL DEFAULT 0,        -- shown in the homepage "Popular Models" grid
    sort_order  INT NOT NULL DEFAULT 0,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO products (category, name, slug, cat_label, spec, badge_text, badge_color, image, featured, sort_order) VALUES
    ('motorcycle',   'HN-M800 Sport',    'hn-m800-sport',    'E-MOTORCYCLE',  '3000W Motor · 72V · 80km/h',            'BEST SELLER',   'red',   'model-m800.jpg', 1, 10),
    ('tricycle',     'HN-T500 Cargo',    'hn-t500-cargo',    'E-TRICYCLE',    '1500W Motor · 60V · 500kg Load',        'HIGH DEMAND',   'navy',  'model-t500.jpg', 1, 20),
    ('bicycle',      'HN-B200 Urban',    'hn-b200-urban',    'E-BICYCLE',     '500W Motor · 48V · 80km Range',         'NEW MODEL',     'green', 'bike-urban.jpg', 1, 30),
    ('four-wheeler', 'HN-Q400 Leisure',  'hn-q400-leisure',  'FOUR-WHEELER',  '5000W Motor · 72V · 4 Seats',           'OEM READY',     'blue',  'model-q400.jpg', 1, 40),
    ('motorcycle',   'HN-M600 Classic',  'hn-m600-classic',  'E-MOTORCYCLE',  '2000W Motor · 60V · 70km/h',            'EEC CERTIFIED', 'red',   'model-m600.jpg', 1, 50),
    ('tricycle',     'HN-T300 Family',   'hn-t300-family',   'E-TRICYCLE',    '1200W Motor · 48V · 300kg Load',        'POPULAR EU',    'navy',  'model-t300.jpg', 1, 60),

    ('bicycle', 'HN-B150 Commuter', 'hn-b150-commuter', 'E-BICYCLE', '350W Motor · 36V · 60km Range',   'HIGH DEMAND',   'navy',  'bike-commuter.jpg', 0, 100),
    ('bicycle', 'HN-B300 Sport',    'hn-b300-sport',     'E-BICYCLE', '750W Motor · 48V · 100km Range',  'BEST SELLER',   'red',   'bike-sport.jpg',    0, 110),
    ('bicycle', 'HN-B100 City',     'hn-b100-city',      'E-BICYCLE', '250W Motor · 36V · 50km Range',   'OEM READY',     'blue',  'bike-city.jpg',     0, 120),
    ('bicycle', 'HN-B400 Cargo',    'hn-b400-cargo',     'E-BICYCLE', '500W Motor · 48V · 120kg Load',   'POPULAR EU',    'navy',  'bike-cargo.jpg',    0, 130),
    ('bicycle', 'HN-B120 Folding',  'hn-b120-folding',   'E-BICYCLE', '250W Motor · 36V · 45km Range',   'EEC CERTIFIED', 'red',   'bike-folding.jpg',  0, 140),

    ('motor',      'HN-MT500',      'hn-mt500',      'HUB MOTOR',      '500W · 48V · Brushless Hub Motor',           'NEW MODEL',   'green', 'motor-hub500.jpg',      0, 200),
    ('motor',      'HN-MT800',      'hn-mt800',      'MID-DRIVE MOTOR','800W · 48V · Mid-Drive Motor',               'BEST SELLER', 'red',   'motor-middrive800.jpg', 0, 210),
    ('motor',      'HN-MT1500',     'hn-mt1500',     'TRICYCLE MOTOR', '1500W · 60V · High-Torque Cargo Motor',      'HIGH DEMAND', 'navy',  'motor-cargo1500.jpg',   0, 220),
    ('controller', 'HN-CT350',      'hn-ct350',      'CONTROLLER',     '350W · 36V · Sine Wave Controller',          'OEM READY',   'blue',  'controller-350.jpg',    0, 230),
    ('controller', 'HN-CT1000',     'hn-ct1000',     'CONTROLLER',     '1000W · 60V · Programmable Controller',      'POPULAR EU',  'navy',  'controller-1000.jpg',   0, 240),
    ('controller', 'HN-CT500 Smart','hn-ct500-smart','CONTROLLER',     '500W · 48V · Bluetooth-Enabled Controller',  'EEC CERTIFIED','red',  'controller-smart500.jpg', 0, 250);

CREATE TABLE posts (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    title          VARCHAR(200) NOT NULL,
    slug           VARCHAR(190) NOT NULL UNIQUE,
    excerpt        VARCHAR(500) NOT NULL,
    body           TEXT NOT NULL,     -- plain paragraphs, one per line; rendered as <p>
    cover_image    VARCHAR(255) NOT NULL DEFAULT '',
    published_at   DATE NOT NULL,
    created_at     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO posts (title, slug, excerpt, body, cover_image, published_at) VALUES
(
    'HANIU Achieves EEC Certification for Three New Models',
    'eec-certification-three-new-models',
    'HN-B300 Sport, HN-M600 Classic, and HN-T300 Family are now cleared for import across the European Economic Area.',
    'HANIU is pleased to announce that three of our most requested models -- the HN-B300 Sport electric bicycle, the HN-M600 Classic electric motorcycle, and the HN-T300 Family electric tricycle -- have completed EEC certification.
This clears a major compliance hurdle for our distribution partners across Europe, removing the need for separate homologation work on their end.
Our export team is ready to discuss shipment timelines and country-specific documentation for any of these three models.',
    'blog-eec-certification.jpg',
    '2026-01-15'
),
(
    'Inside Our Wuxi Powertrain Base',
    'inside-wuxi-powertrain-base',
    'A look at how HANIU develops and tests every motor and controller before it reaches a vehicle.',
    'Our Wuxi facility sits in the heart of the Yangtze River Delta, China\'s most advanced electronics manufacturing corridor.
Every hub motor, mid-drive unit, and controller that ships in a HANIU vehicle is designed, wound, and bench-tested at this site before it ever reaches an assembly line.
This vertical integration is what lets us hold tight tolerances on power output and efficiency, and respond quickly when an OEM partner needs a custom spec.',
    'blog-wuxi-powertrain.jpg',
    '2025-12-02'
),
(
    'A Distributor\'s Guide to HANIU MOQs',
    'distributor-guide-moqs',
    'What minimum order quantities actually look like for new partners, by product category.',
    'One of the most common questions from new distributors is simple: how many units do I need to order to get started?
The honest answer varies by category -- container-optimized categories like e-bicycles and e-tricycles have lower per-SKU minimums than four-wheelers, and OEM/ODM projects are quoted individually based on customization scope.
Reach out through our contact form with your target market and expected volume, and our export team will send back a specific number within one business day.',
    'blog-moq-guide.jpg',
    '2025-11-10'
);

CREATE TABLE messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    full_name  VARCHAR(150) NOT NULL,
    company    VARCHAR(150) NOT NULL DEFAULT '',
    email      VARCHAR(190) NOT NULL,
    country    VARCHAR(100) NOT NULL,
    message    TEXT NOT NULL,
    source     VARCHAR(100) NOT NULL DEFAULT '', -- which page the inquiry came from
    is_read    TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
