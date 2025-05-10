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
                'gender'      => 'woman',
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
                'gender'      => 'woman',
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
                'gender'      => 'woman',
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
                'gender'      => 'woman',
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
                'gender'      => 'woman',
                'description' => 'Sleek sterling-silver signet ring with a smooth oval face ready for personal engraving.',
                'summary'     => 'Sleek sterling-silver signet',
                'popularity'     => 1,
            ],

                // 31
            [
                'title'       => 'Cross Signet Ring',
                'sku'         => 'RING-031',
                'slug'        => 'cross-signet-ring',
                'price'       => 169.00,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'A classic sterling-silver signet ring featuring a raised cross motif on an oval face. Smooth tapered shank and low profile for comfortable everyday wear.',
                'summary'     => 'Sterling-silver signet with cross detail',
                'popularity'  => 16,
            ],
            // 32
            [
                'title'       => 'Flat Edge Band Ring',
                'sku'         => 'RING-032',
                'slug'        => 'flat-edge-band-ring',
                'price'       => 99.90,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Minimal flat-edge band crafted from polished sterling silver. Clean, understated design that stacks easily with other rings or looks crisp on its own.',
                'summary'     => 'Polished sterling-silver flat band',
                'popularity'  => 8,
            ],
            // 33
            [
                'title'       => 'Blue Opal Eternity Band',
                'sku'         => 'RING-033',
                'slug'        => 'blue-opal-eternity-band',
                'price'       => 189.50,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Sterling-silver eternity band accented with bezel-set oval blue opal cabochons all around. Subtle scalloped edges add texture and a pop of iridescent color.',
                'summary'     => 'Sterling band with oval blue opals',
                'popularity'  => 14,
            ],
            // 34
            [
                'title'       => 'Gold Cross Motif Band',
                'sku'         => 'RING-034',
                'slug'        => 'gold-cross-motif-band',
                'price'       => 249.00,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'gold',
                'gender'      => 'man',
                'description' => 'A bold gold-plated band ring featuring repeating cut-out cross motifs and a textured crown-edge profile. Statement piece with subtle gothic influence.',
                'summary'     => 'Gold band with repeating cross cut-outs',
                'popularity'  => 19,
            ],
            // 35
            [
                'title'       => 'Domed Signet Ring',
                'sku'         => 'RING-035',
                'slug'        => 'domed-signet-ring',
                'price'       => 129.75,
                'discount'    => 0,
                'category'    => 'rings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'A bold yet refined domed signet ring in mirror-polished sterling silver. Blank face ready for engraving or worn sleek and minimalist.',
                'summary'     => 'Polished domed sterling signet',
                'popularity'  => 11,
            ],
                // NECKLACES
            [
                'title'       => 'Diamond Arrow Chain Bracelet',
                'sku'         => 'NECKLACE-006',
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
                'sku'         => 'NECKLACE-007',
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
                'sku'         => 'NECKLACE-008',
                'slug'        => 'paperclip-link-gold-bracelet',
                'price'       => 59.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'gold',
                'gender'      => 'woman',
                'description' => 'On-trend elongated paperclip links in high-polish gold with an oversized toggle clasp.',
                'summary'     => 'Trendy paperclip-link gold bracelet',
                'popularity'     => 13,
            ],
            [
                'title'       => 'Slim Diamond Bar Bracelet',
                'sku'         => 'NECKLACE-009',
                'slug'        => 'slim-diamond-bar-bracelet',
                'price'       => 79.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'diamond',
                'gender'      => 'woman',
                'description' => 'Minimalist bracelet showcasing a slender diamond-pavé bar on a barely-there chain.',
                'summary'     => 'Minimalist pavé-diamond bar bracelet',
                'popularity'     => 4,
            ],
            [
                'title'       => 'Polished Silver Cuff Bracelet',
                'sku'         => 'NECKLACE-010',
                'slug'        => 'polished-silver-cuff-bracelet',
                'price'       => 49.99,
                'discount'    => 0,
                'category'    => 'bracelets',
                'color'       => 'silver',
                'gender'      => 'woman',
                'description' => 'Sleek open-ended cuff forged from sterling silver, finished with a mirror-like polish.',
                'summary'     => 'Sleek sterling-silver cuff',
                'popularity'     => 12,
            ],
            [
                'title'       => 'Paperclip Link Gold Necklace',
                'sku'         => 'NECKLACE-001',
                'slug'        => 'paperclip-link-gold-necklace',
                'price'       => 89.99,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'woman',
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
                'gender'      => 'woman',
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
                'gender'      => 'woman',
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
            // 21
            [
                'title'       => 'Gold Tennis Chain Necklace 4 mm',
                'sku'         => 'NECKLACE-021',
                'slug'        => 'gold-tennis-chain-4mm',
                'price'       => 299.00,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'man',
                'description' => 'A classic 4 mm tennis chain plated in 14 k gold and handset with brilliant-cut simulated diamonds for uninterrupted sparkle. Finished with a seamless hidden clasp.',
                'summary'     => '4 mm gold-tone simulated-diamond tennis chain',
                'popularity'  => 12,
            ],

            // 22
            [
                'title'       => 'Gold Tennis Chain Necklace 2 mm',
                'sku'         => 'NECKLACE-022',
                'slug'        => 'gold-tennis-chain-2mm',
                'price'       => 249.50,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'man',
                'description' => 'A slim 2 mm tennis chain in warm gold tone, featuring petite round simulated diamonds in four-prong settings. Lightweight, flexible, and ideal for layering.',
                'summary'     => '2 mm gold-tone tennis chain for subtle shine',
                'popularity'  => 9,
            ],
            // 23
            [
                'title'       => 'Diamond-Cut Curb Chain 5 mm',
                'sku'         => 'NECKLACE-023',
                'slug'        => 'diamond-cut-curb-chain-5mm',
                'price'       => 229.00,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'A 5 mm diamond-cut curb chain in polished stainless steel for crisp reflective sparkle. Finished with a lobster clasp for everyday durability.',
                'summary'     => 'Polished 5 mm curb-link chain',
                'popularity'  => 13,
            ],

            // 24
            [
                'title'       => 'Iced Rope Chain 8 mm',
                'sku'         => 'NECKLACE-024',
                'slug'        => 'iced-rope-chain-8mm',
                'price'       => 319.50,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Bold 8 mm rope chain fully micro-pavé-set with clear simulated diamonds for head-turning shine. Secure box clasp keeps the weighty piece locked in place.',
                'summary'     => '8 mm pavé rope-style chain',
                'popularity'  => 18,
            ],

            // 25
            [
                'title'       => 'Tennis Chain Necklace 3 mm',
                'sku'         => 'NECKLACE-025',
                'slug'        => 'tennis-chain-necklace-3mm',
                'price'       => 279.00,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'A sleek 3 mm tennis chain lined with brilliant-cut simulated diamonds for continuous sparkle. Low-profile four-prong settings and hidden clasp for a seamless look.',
                'summary'     => '3 mm simulated-diamond tennis chain',
                'popularity'  => 15,
            ],

            //BRACELETS - first are mans
            // 26
            [
                'title'       => 'Classic Tennis Bracelet',
                'sku'         => 'BRACELET-026',
                'slug'        => 'classic-tennis-bracelet',
                'price'       => 219.00,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'An elegant tennis bracelet featuring a continuous row of brilliant-cut simulated diamonds set in polished sterling silver. Perfect layered or worn solo for a refined statement.',
                'summary'     => 'Sterling-silver tennis bracelet with simulated diamonds',
                'popularity'  => 14,
            ],

            // 27
            [
                'title'       => 'Iced Cuban Link Bracelet',
                'sku'         => 'BRACELET-027',
                'slug'        => 'iced-cuban-link-bracelet',
                'price'       => 289.50,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'A hefty Cuban curb-link bracelet fully pavé-set with micro simulated diamonds for head-turning shine. Bold street-lux styling with a secure box clasp.',
                'summary'     => 'Pavé-set Cuban curb-link bracelet',
                'popularity'  => 18,
            ],

            // 28
            [
                'title'       => 'Radiant Tennis Bracelet 4 mm',
                'sku'         => 'BRACELET-028',
                'slug'        => 'radiant-tennis-bracelet-4mm',
                'price'       => 199.00,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Sport-meets-luxury: a 4 mm tennis bracelet lined with brilliant simulated diamonds that strikes the balance between subtle and statement. Finished with a double-safety clasp.',
                'summary'     => '4 mm sterling-silver tennis bracelet',
                'popularity'  => 10,
            ],
            // 29
            [
                'title'       => 'Slim Gold Tennis Bracelet',
                'sku'         => 'BRACELET-041',
                'slug'        => 'slim-gold-tennis-bracelet',
                'price'       => 239.00,               // ≤ 500 €
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'gold',
                'gender'      => 'man',
                'description' => 'A sleek 3 mm tennis bracelet plated in 14-karat gold and handset with brilliant-cut simulated diamonds for subtle, continuous sparkle. Flexible links and a low-profile clasp keep it comfortable for everyday wear.',
                'summary'     => 'Slim 14 k-gold tennis bracelet',
                'popularity'  => 15,                   // 0 – 20
            ],
            // 30
            [
                'title'       => 'Slim Tennis Bracelet',
                'sku'         => 'BRACELET-030',
                'slug'        => 'slim-tennis-bracelet',
                'price'       => 169.75,
                'discount'    => 0,
                'category'    => 'necklaces',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'An ultra-slim tennis bracelet showcasing petite clear stones for understated sparkle. Low-profile settings and smooth edges keep it comfortable for everyday wear.',
                'summary'     => 'Slim sterling-silver tennis bracelet',
                'popularity'  => 7,
            ],


            //TU ESTE MUSIM PRIDAT ZENSKE

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
                'gender'      => 'woman',
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
                'gender'      => 'woman',
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

            // 36
            [
                'title'       => 'Emerald-Cut Crystal Studs',
                'sku'         => 'EARRINGS-036',
                'slug'        => 'emerald-cut-crystal-studs',
                'price'       => 139.00,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Minimalist stud earrings featuring an emerald-cut clear crystal set in polished sterling-silver prongs. Clean lines, maximum shine.',
                'summary'     => 'Silver square-cut crystal studs',
                'popularity'  => 17,
            ],
            // 37
            [
                'title'       => 'Classic Round Solitaire Studs',
                'sku'         => 'EARRINGS-037',
                'slug'        => 'classic-round-solitaire-studs',
                'price'       => 149.50,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Iconic studs showcasing a single round clear cubic zirconia in a smooth sterling-silver setting. A versatile everyday essential.',
                'summary'     => 'Silver solitaire crystal studs',
                'popularity'  => 12,
            ],
            //38
            [
                'title'       => 'Champagne Halo Studs',
                'sku'         => 'EARRINGS-041',
                'slug'        => 'champagne-halo-studs',
                'price'       => 149.50,               // ≤ 500 €
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'gold',
                'gender'      => 'man',
                'description' => 'Petite halo stud earrings featuring a warm champagne-tone center stone encircled by a pavé frame of clear simulated diamonds, all set in polished 14-karat gold plating. Compact size with statement-level shine.',
                'summary'     => 'Gold halo studs with champagne center',
                'popularity'  => 13,                   // 0 – 20
            ],
            // 39
            [
                'title'       => 'Halo Studs with Ice-Blue Center',
                'sku'         => 'EARRINGS-039',
                'slug'        => 'halo-studs-ice-blue',
                'price'       => 179.00,
                'discount'    => 0,
                'category'    => 'earrings',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Stud earrings featuring an ice-blue central crystal framed by a pavé halo of tiny clear stones. Diamond-like brilliance with a modern pop of color.',
                'summary'     => 'Silver halo studs with blue center',
                'popularity'  => 20,
            ],
            // 40
            [
                'title'       => 'Mini Hoop Cuffs with Star Details',
                'sku'         => 'EARRINGS-040',
                'slug'        => 'mini-hoop-cuffs-star',
                'price'       => 89.95,
                'discount'    => 0,
                'category'    => 'hoops',
                'color'       => 'silver',
                'gender'      => 'man',
                'description' => 'Compact C-hoop earrings in polished stainless steel, accented with star-shaped cubic zirconia. Comfortable, stackable, and easy to style.',
                'summary'     => 'Silver mini hoops with stars',
                'popularity'  => 9,
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
