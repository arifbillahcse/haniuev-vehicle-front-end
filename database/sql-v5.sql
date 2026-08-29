-- HANIU EV — migration v5: manageable certificates for the About page.

CREATE TABLE certificates (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(150) NOT NULL,
    image      VARCHAR(255) NOT NULL DEFAULT '',
    sort_order INT NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Carries over the two certificates already uploaded, so nothing regresses.
INSERT INTO certificates (name, image, sort_order) VALUES
    ('ISO 9001:2015 Quality Management (Chinese)', 'certificates1.jpeg', 10),
    ('ISO 9001:2015 Quality Management (English)', 'certificates2.jpeg', 20);
