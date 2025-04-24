INSERT INTO IMAGES (id, url) VALUES
  (1, 'database/seeders/product1-1.jpg'),
  (2, 'database/seeders/product1-2.jpg'),
  (3, 'database/seeders/product1-3.jpg'),
  (4, 'database/seeders/product1-4.jpg'),
  (5, 'database/seeders/product2-1.jpg'),
  (6, 'database/seeders/product2-2.jpg'),
  (7, 'database/seeders/product2-3.jpg'),
  (8, 'database/seeders/product2-4.jpg'),
  (9, 'database/seeders/product3-1.jpg'),
  (10, 'database/seeders/product2-1.jpg')
  
INSERT INTO PRODUCTS (
  id,
  title,
  sku,
  slug,
  price,
  discount,
  category,
  color,
  gender,
  description,
  summary,
  created_at,
  updated_at,
  deleted_at
) VALUES
  (1,  'Gold Diamond Ring',         'RNG1001', 'gold-diamond-ring',          250, 15, 'rings',     'Gold',      'Women', 'Elegant gold ring with a brilliant‑cut diamond.',             'Elegant diamond ring',         NOW(), NOW(), NULL),
  (2,  'Silver Band Ring',          'RNG1002', 'silver-band-ring',           120,  5, 'rings',     'Silver',    'Unisex','Classic polished silver band, timeless and versatile.',       'Classic silver band',          NOW(), NOW(), NULL),
  (3,  'Emerald Cocktail Ring',     'RNG1003', 'emerald-cocktail-ring',      320, 10, 'rings',     'Green',     'Women', 'Statement cocktail ring featuring a large emerald stone.',       'Emerald statement ring',       NOW(), NOW(), NULL),
  (4,  'Pearl Necklace',            'NEC1004', 'pearl-necklace',            180, 10, 'necklaces', 'White',     'Women', 'Classic freshwater pearl necklace, perfect for any occasion.',  'Classic pearl necklace',      NOW(), NOW(), NULL),
  (5,  'Rose Gold Pendant',         'NEC1005', 'rose-gold-pendant',         200,  0, 'necklaces', 'Rose Gold', 'Man', 'Delicate rose‑gold chain with a minimalist pendant.',           'Minimalist pendant',          NOW(), NOW(), NULL),
  (6,  'Sapphire Choker Necklace',  'NEC1006', 'sapphire-choker-necklace',   220,  8, 'necklaces', 'Blue',      'Women', 'Choker‑style necklace set with faceted sapphire beads.',         'Sapphire choker',             NOW(), NOW(), NULL),
  (7,  'Silver Charm Bracelet',     'BRL1007', 'silver-charm-bracelet',      120,  5, 'bracelets', 'Silver',    'Unisex','Stylish silver bracelet featuring multiple dangling charms.', 'Stylish charm bracelet',       NOW(), NOW(), NULL),
  (8,  'Leather Wrap Bracelet',     'BRL1008', 'leather-wrap-bracelet',      75,  20, 'bracelets', 'Brown',     'Unisex','Genuine leather wrap bracelet with an adjustable metal clasp.', 'Leather wrap bracelet',        NOW(), NOW(), NULL),
  (9,  'Beaded Stretch Bracelet',   'BRL1009', 'beaded-stretch-bracelet',     50,   0, 'bracelets', 'Multicolor','Unisex','Comfortable stretch bracelet made of colorful glass beads.',     'Beaded stretch bracelet',     NOW(), NOW(), NULL),
  (10, 'Rose Gold Stud Earrings',   'EAR1010', 'rose-gold-stud-earrings',     90,   0, 'earrings',  'Rose Gold', 'Women', 'Minimalist stud earrings in a warm rose‑gold finish.',           'Minimalist studs',             NOW(), NOW(), NULL),
  (11, 'Classic Hoop Earrings',     'EAR1011', 'classic-hoop-earrings',       65,   5, 'earrings',  'Gold',      'Man', 'Medium‑sized gold hoop earrings for everyday wear.',            'Gold hoop earrings',          NOW(), NOW(), NULL),
  (12, 'Drop Diamond Earrings',     'EAR1012', 'drop-diamond-earrings',      180, 12, 'earrings',  'White',     'Man', 'Elegant drop earrings set with small round diamonds.',         'Elegant diamond drops',       NOW(), NOW(), NULL);


/*
SELECT * FROM images
SELECT * FROM products

--DELETIN FORM
WITH to_delete AS (
  SELECT id
  FROM PRODUCTS
  ORDER BY id
)
DELETE FROM PRODUCTS
USING to_delete
WHERE PRODUCTS.id = to_delete.id;