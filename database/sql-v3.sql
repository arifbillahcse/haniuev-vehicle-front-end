-- HANIU EV — migration v3: custom product specification rows.
-- Lets each product carry its own arbitrary label/value spec list
-- (Motor, Battery, Range, Charging Time, Colors, Certification, etc.)
-- with no fixed set of columns.

CREATE TABLE product_specs (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    label      VARCHAR(100) NOT NULL,
    value      VARCHAR(255) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_product_specs_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
