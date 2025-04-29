<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Predurčené produkty
        $products = [
            // Rings
            [
                'title'       => 'Classic Gold Band',
                'sku'         => 'RING-001',
                'slug'        => 'classic-gold-band',
                'price'       => 59.99,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Timeless 14-karat gold band with a mirror-polished finish – perfect for stacking or wearing solo.',
                'summary'     => 'Timeless polished gold band',
                'popularity'     => 10,
            ],
            [
                'title'       => 'Textured Gold Band',
                'sku'         => 'RING-002',
                'slug'        => 'textured-gold-band',
                'price'       => 64.99,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Lightweight gold band featuring a subtle hammered texture that catches the light beautifully.',
                'summary'     => 'Hammered-texture gold ring',
                'popularity'     => 3,
            ],
            [
                'title'       => 'Twisted Rope Gold Ring',
                'sku'         => 'RING-003',
                'slug'        => 'twisted-rope-gold-ring',
                'price'       => 74.99,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Eye-catching rope-twist design crafted in polished gold plating for a bold yet refined look.',
                'summary'     => 'Polished rope-twist gold ring',
                'popularity'     => 0,
            ],
            [
                'title'       => 'Diamond Bow Statement Ring',
                'sku'         => 'RING-004',
                'slug'        => 'diamond-bow-statement-ring',
                'price'       => 129.99,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'diamond',
                'gender'      => 'unisex',
                'description' => 'Delicate bow silhouette paved with brilliant-cut simulated diamonds set on a slim gold band.',
                'summary'     => 'Bow ring with sparkling diamonds',
                'popularity'     => 19,
            ],
            [
                'title'       => 'Minimalist Silver Signet Ring',
                'sku'         => 'RING-005',
                'slug'        => 'minimalist-silver-signet-ring',
                'price'       => 49.99,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'silver',
                'gender'      => 'unisex',
                'description' => 'Sleek sterling-silver signet ring with a smooth oval face ready for personal engraving.',
                'summary'     => 'Sleek sterling-silver signet',
                'popularity'     => 1,
            ],

            // Bracelets  (produkty 6 – 10)
            [
                'title'       => 'Diamond Arrow Chain Bracelet',
                'sku'         => 'BRACELET-001',
                'slug'        => 'diamond-arrow-chain-bracelet',
                'price'       => 69.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Delicate gold cable-chain bracelet featuring a pavé-diamond arrow motif and adjustable spring-ring clasp.',
                'summary'     => 'Gold chain bracelet with pavé arrow',
                'popularity'     => 0,
            ],
            [
                'title'       => 'Gold Diamond Tennis Bracelet',
                'sku'         => 'BRACELET-002',
                'slug'        => 'gold-diamond-tennis-bracelet',
                'price'       => 129.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'diamond',
                'gender'      => 'unisex',
                'description' => 'Classic bezel-set diamond tennis bracelet crafted in yellow-gold plating for continuous sparkle.',
                'summary'     => 'Bezel-set diamond tennis bracelet',
                'popularity'     => 12,
            ],
            [
                'title'       => 'Paperclip Link Gold Bracelet',
                'sku'         => 'BRACELET-003',
                'slug'        => 'paperclip-link-gold-bracelet',
                'price'       => 59.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'On-trend elongated paperclip links in high-polish gold with an oversized toggle clasp.',
                'summary'     => 'Trendy paperclip-link gold bracelet',
                'popularity'     => 13,
            ],
            [
                'title'       => 'Slim Diamond Bar Bracelet',
                'sku'         => 'BRACELET-004',
                'slug'        => 'slim-diamond-bar-bracelet',
                'price'       => 79.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'diamond',
                'gender'      => 'unisex',
                'description' => 'Minimalist bracelet showcasing a slender diamond-pavé bar on a barely-there chain.',
                'summary'     => 'Minimalist pavé-diamond bar bracelet',
                'popularity'     => 4,
            ],
            [
                'title'       => 'Polished Silver Cuff Bracelet',
                'sku'         => 'BRACELET-005',
                'slug'        => 'polished-silver-cuff-bracelet',
                'price'       => 49.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'silver',
                'gender'      => 'unisex',
                'description' => 'Sleek open-ended cuff forged from sterling silver, finished with a mirror-like polish.',
                'summary'     => 'Sleek sterling-silver cuff',
                'popularity'     => 12,
            ],

            // Necklaces  (produkty 11 – 15)
            [
                'title'       => 'Paperclip Link Gold Necklace',
                'sku'         => 'NECKLACE-001',
                'slug'        => 'paperclip-link-gold-necklace',
                'price'       => 89.99,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Bold paperclip-style links in high-polish gold, finished with a statement circle-toggle clasp.',
                'summary'     => 'Gold paperclip-link statement necklace',
                'popularity'     => 1,
            ],
            [
                'title'       => 'Minimal Gold Bar Pendant Necklace',
                'sku'         => 'NECKLACE-002',
                'slug'        => 'minimal-gold-bar-pendant-necklace',
                'price'       => 59.99,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Sleek gold bar pendant suspended from a fine cable chain – perfect for everyday layers.',
                'summary'     => 'Sleek gold bar pendant on fine chain',
                'popularity'     => 1,
            ],
            [
                'title'       => 'Polished Silver Tag Necklace',
                'sku'         => 'NECKLACE-003',
                'slug'        => 'polished-silver-tag-necklace',
                'price'       => 54.99,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'unisex',
                'description' => 'High-shine sterling-silver tag on a sturdy yet refined curb chain – a modern unisex essential.',
                'summary'     => 'Sterling-silver tag curb-chain necklace',
                'popularity'     => 1,
            ],
            [
                'title'       => 'Diamond Disc Station Necklace',
                'sku'         => 'NECKLACE-004',
                'slug'        => 'diamond-disc-station-necklace',
                'price'       => 119.99,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'diamond',
                'gender'      => 'unisex',
                'description' => 'Five pavé-diamond discs spaced evenly along a delicate gold chain for subtle sparkle.',
                'summary'     => 'Gold chain with pavé-diamond discs',
                'popularity'     => 4,
            ],
            [
                'title'       => 'Layered Gold Chain Necklace',
                'sku'         => 'NECKLACE-005',
                'slug'        => 'layered-gold-chain-necklace',
                'price'       => 79.99,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'unisex',
                'description' => 'Pre-layered double-strand necklace combining a fine curb chain with a slender snake chain in rich gold.',
                'summary'     => 'Pre-layered double gold chain necklace',
                'popularity'     => 4,
            ],

            // Earrings  (produkty 16 – 20)
            [
                'title'       => 'Petite Gold Huggie Hoops',
                'sku'         => 'EARRINGS-001',
                'slug'        => 'petite-gold-huggie-hoops',
                'price'       => 34.99,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'gold',          // malé hladké kruhy
                'gender'      => 'unisex',
                'description' => 'Every-day huggie hoops crafted in high-polish gold plating with a discreet hinge closure.',
                'summary'     => 'Mini gold huggie earrings',
                'popularity'     => 5,
            ],
            [
                'title'       => 'Turquoise Huggie Hoops',
                'sku'         => 'EARRINGS-002',
                'slug'        => 'turquoise-huggie-hoops',
                'price'       => 39.99,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'gold',          // zlatá základňa, tyrkysové kamene
                'gender'      => 'unisex',
                'description' => 'Gold huggie earrings lined with vivid turquoise cabochons for a pop of colour.',
                'summary'     => 'Gold huggies with turquoise stones',
                'popularity'     => 5,
            ],
            [
                'title'       => 'Chunky Silver Hoops',
                'sku'         => 'EARRINGS-003',
                'slug'        => 'chunky-silver-hoops',
                'price'       => 44.99,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'silver',
                'gender'      => 'unisex',
                'description' => 'Bold, smooth sterling-silver hoops with a modern chunky profile and secure latch fastening.',
                'summary'     => 'Bold sterling-silver hoop earrings',
                'popularity'     => 5,
            ],
            [
                'title'       => 'Slim Silver Sleeper Hoops',
                'sku'         => 'EARRINGS-004',
                'slug'        => 'slim-silver-sleeper-hoops',
                'price'       => 29.99,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'silver',
                'gender'      => 'unisex',
                'description' => 'Lightweight sleeper-style hoops in polished silver, designed for comfortable all-night wear.',
                'summary'     => 'Lightweight silver sleeper hoops',
                'popularity'     => 50,
            ],
            [
                'title'       => 'Diamond Pavé Studs',
                'sku'         => 'EARRINGS-005',
                'slug'        => 'diamond-pave-studs',
                'price'       => 59.99,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'diamond',
                'gender'      => 'unisex',
                'description' => 'Round gold studs fully pavéd with brilliant-cut simulated diamonds for maximum sparkle.',
                'summary'     => 'Gold studs with pavé diamonds',
                'popularity'     => 12,
            ],
        ];

        // ======== ULOŽENIE: doplníme “details” a vytvoríme =========
        foreach ($products as $data) {
            $data['details'] = $this->makeDetails($data);   // <– nový kľúč
            Product::create($data);
        }
    }

    /**
     * Dynamicky vygeneruje DETAIL z údajov produktu.
     * Vracia text s odradkovanými bodmi.
     */
    private function makeDetails(array $p): string
    {
        return implode("\n", [
            'Category: '  . ucfirst($p['category']   ?? '—'),
            'Color: '     . ucfirst($p['color']      ?? '—'),
            'Gender: '    . ucfirst($p['gender']     ?? '—'),
            'Price: €'    . number_format($p['price'], 2, ',', ' '),
            'Summary: '   . ($p['summary'] ?? $p['description']),
        ]);
    }
}
