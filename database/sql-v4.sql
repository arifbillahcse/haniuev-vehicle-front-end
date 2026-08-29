-- HANIU EV — migration v4: site settings (social media links).
-- Generic key/value store so future site-wide settings can reuse it
-- without another migration.

CREATE TABLE settings (
    setting_key   VARCHAR(60) NOT NULL PRIMARY KEY,
    setting_value VARCHAR(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO settings (setting_key, setting_value) VALUES
    ('social_linkedin', ''),
    ('social_facebook', ''),
    ('social_instagram', ''),
    ('social_youtube', ''),
    ('social_tiktok', ''),
    ('social_whatsapp', '');
