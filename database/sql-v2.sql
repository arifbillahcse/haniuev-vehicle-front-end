-- HANIU EV — migration v2: single product detail pages.
-- Adds a long-form description and catalog PDF to products, plus a
-- product_images table for the detail-page photo gallery.

ALTER TABLE products
    ADD COLUMN description TEXT NULL AFTER spec,
    ADD COLUMN catalog_pdf VARCHAR(255) NOT NULL DEFAULT '' AFTER image;

CREATE TABLE product_images (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image      VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_product_images_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
