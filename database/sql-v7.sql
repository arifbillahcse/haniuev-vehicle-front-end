-- HANIU EV — migration v7: rename the 4 vehicle categories to match the
-- Vehicles nav menu labels. The nav dropdown text was updated earlier, but
-- the underlying categories.name values were never changed to match, so
-- the admin category list still showed "Bicycle"/"Motorcycle"/"Tricycle"/
-- "Four-Wheeler" instead of the names shown on the site.

UPDATE categories SET name = 'Electric Bicycle'       WHERE slug = 'bicycle';
UPDATE categories SET name = 'Electric Bike'           WHERE slug = 'motorcycle';
UPDATE categories SET name = 'Electric Three Wheeler'  WHERE slug = 'tricycle';
UPDATE categories SET name = 'Electric Four Wheeler'   WHERE slug = 'four-wheeler';
