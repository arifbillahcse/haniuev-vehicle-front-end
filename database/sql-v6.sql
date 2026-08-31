-- HANIU EV — migration v6: detailed parts taxonomy.
-- These automatically appear on the "All Parts" page (all-parts.php
-- shows every category except the 4 vehicle types) and become
-- selectable for products from admin/products.php — no code change
-- needed for either.

INSERT INTO categories (slug, name, pill, lead, sort_order) VALUES
    ('battery-bms',            'Battery & BMS',            'POWER SYSTEMS',          'Battery packs, BMS units, battery cases, connectors, and terminals.', 100),
    ('motor-drive',            'Motor & Drive System',     'POWERTRAIN',             'Hub motors, differential motors, drive motors, motor gears, and motor components.', 110),
    ('controller-electrical',  'Controller & Electrical',  'ELECTRICAL SYSTEMS',     'Controllers, DC-DC converters, relays, contactors, fuses, and wiring harnesses.', 120),
    ('charger-charging',       'Charger & Charging',       'CHARGING SOLUTIONS',     'Chargers, charging ports, charging cables, and charging components.', 130),
    ('braking-system',         'Braking System',           'SAFETY & CONTROL',       'Brake drums, brake discs, calipers, brake shoes, master cylinders, brake cables, and brake switches.', 140),
    ('wheels-rims-tyres',      'Wheels, Rims & Tyres',     'RUNNING GEAR',           'Tyres, rims, wheel hubs, tubes, bearings, and wheel accessories.', 150),
    ('suspension-steering',    'Suspension & Steering',    'RIDE & HANDLING',        'Front forks, shock absorbers, steering columns, tie rods, ball joints, and steering components.', 160),
    ('lighting-instruments',   'Lighting & Instruments',   'VISIBILITY & DISPLAY',   'Headlights, taillights, turn signals, horns, switches, digital displays, and instrument clusters.', 170),
    ('body-interior',          'Body & Interior',          'BODY & COMFORT',         'Body panels, fenders, bumpers, seats, cushions, doors, mirrors, and handles.', 180),
    ('drivetrain-mechanical',  'Drivetrain & Mechanical',  'MECHANICAL SYSTEMS',     'Axles, differentials, gears, chains, sprockets, drive shafts, bearings, and mechanical components.', 190),
    ('other-accessories',      'Other Accessories',        'ACCESSORIES',           'Baskets, cargo racks, footrests, vehicle covers, locks, USB accessories, fasteners, trim, and miscellaneous accessories.', 200);
