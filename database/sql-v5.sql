-- HANIU EV — migration v5: manageable certificates for the About page.

CREATE TABLE certificates (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(150) NOT NULL,
    image      VARCHAR(255) NOT NULL DEFAULT '',
    sort_order INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seeded with the certificates already uploaded, so nothing regresses.
INSERT INTO certificates (name, image, sort_order) VALUES
    ('ISO 9001:2015 Quality Management (English)', 'certificate-iso9001-en.png', 10),
    ('ISO 9001:2015 Quality Management (Chinese)', 'certificate-iso9001-cn.png', 20),
    ('World Manufacturer Identifier (WMI) Certificate', 'certificate-wmi-1.png', 30),
    ('World Manufacturer Identifier (WMI) Certificate — Renewal', 'certificate-wmi-2.png', 40),
    ('HANIU Trademark Registration Certificate', 'certificate-trademark.png', 50);
