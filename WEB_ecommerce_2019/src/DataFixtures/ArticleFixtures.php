<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\ArticlePurpose;
use App\Entity\ArticleType;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Compatibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public $articles = [
        ['category_id' => 2, 'compatibility_id' => 11, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 58, 'cart_id' => null,
            'title' => "Taipan - Evil Geniuses",
            'content' => "The Taipan - Evil Geniuses by Razer uses a Laser sensor, providing a DPI/CPI range of 8400dpi. This results in a tracking speed of 200ips, and a maximum acceleration of 50G. It uses a USB connection. The Taipan - Evil Geniuses is considered to be an ambidextrous mouse.  It weighs in at 95g grams with the cable and is approximately 124 x 63 x 36 mm (LxWxH).",
            'weight' => 95, 'height' => 36, 'width' => 63, 'length' => 124, 'stock' => 15, 'price' => 60,
            'imageMain' => "https://www.gamergear.net/content/product/575/thumb-Razer-Tipan-Evil-Geniuses-2012.png", 'image1' => "https://www.gamergear.net/content/product/575/thumb-Razer-Tipan-Evil-Geniuses-2013.png", 'image2' => "https://www.gamergear.net/content/product/575/thumb-Razer-Tipan-Evil-Geniuses-2014.png", 'image3' => "https://www.gamergear.net/content/product/575/thumb-Razer-Tipan-Evil-Geniuses-2015.png", 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 12, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 58, 'cart_id' => null,
            'title' => "Naga Epic Chroma",
            'content' => "The Naga Epic Chroma by Razer uses a Laser sensor from Philips, specifically the PLN 2034, providing a DPI/CPI range of 8200dpi. This is combined with a 32 bit ARM. This results in a tracking speed of 200ips. It uses a USB, Wireless connection with a 2.1m braided cable. It weighs in at 150g grams with the cable and is approximately 119 x 75 x 43mm (LxWxH).",
            'weight' => 150, 'height' => 43, 'width' => 75, 'length' => 119, 'stock' => 25, 'price' => 31,
            'imageMain' => "https://www.gamergear.net/content/product/819/thumb-Razer-Naga-Epic-Chroma-2992.png", 'image1' => "https://www.gamergear.net/content/product/819/thumb-Razer-Naga-Epic-Chroma-2990.png", 'image2' => "https://www.gamergear.net/content/product/819/thumb-Razer-Naga-Epic-Chroma-2991.png", 'image3' => "https://www.gamergear.net/content/product/819/thumb-Razer-Naga-Epic-Chroma-2992.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 58, 'cart_id' => null,
            'title' => "Abyssus V2",
            'content' => "The Abyssus V2 by Razer uses an Optical sensor, providing a DPI/CPI range of 5000 dpi. This results in a tracking speed of 100 IPS, and a maximum acceleration of 30 g. It uses a USB connection. The Abyssus V2 is considered to be an ambidextrous mouse.  It weighs in at 111 g grams with the cable and 80 g without the cable and is approximately 117 x 64 x 38 mm (LxWxH).",
            'weight' => 111, 'height' => 38, 'width' => 64, 'length' => 117, 'stock' => 14, 'price' => 106,
            'imageMain' => "https://www.gamergear.net/content/product/1092/thumb_abyssus-v2-003.png", 'image1' => "https://www.gamergear.net/content/product/1092/thumb_abyssus-v2-002.png", 'image2' => "https://www.gamergear.net/content/product/1092/thumb_abyssus-v2-003.png", 'image3' => "https://www.gamergear.net/content/product/1092/thumb_abyssus-v2-004.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 58, 'cart_id' => null,
            'title' => "DeathAdder V2",
            'content' => "The DeathAdder V2 by Razer uses an Optical sensor, specifically the Focus+, providing a DPI/CPI range of upto 20,000 DPI. This results in a tracking speed of 650 ips, and a maximum acceleration of 50 G . It uses a USB connection with a 2.1 m, Speedflex cable cable. It weighs in at 82 g  without the cable and is approximately 127. x 61.7x 42.7 mm (LxWxH).",
            'weight' => 0, 'height' => 42, 'width' => 61, 'length' => 127, 'stock' => 0, 'price' => 107,
            'imageMain' => "https://www.gamergear.net/content/product/2020/01/1759/thumb-DeathAdder-V2-2019-0002.png", 'image1' => "https://www.gamergear.net/content/product/2020/01/1759/thumb-DeathAdder-V2-2019-0002.png", 'image2' => "https://www.gamergear.net/content/product/2020/01/1759/thumb-DeathAdder-V2-2019-0003.png", 'image3' => "https://www.gamergear.net/content/product/2020/01/1759/thumb-DeathAdder-V2-2019-0004.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 40, 'cart_id' => null,
            'title' => "Vengeance M95",
            'content' => "The Vengeance M95 by Corsair uses a Laser sensor from Avago, the ADNS-A9800, providing a DPI/CPI range of up to 8200dpi. It uses a USB connection.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 24, 'price' => 112,
            'imageMain' => "https://www.gamergear.net/content/product/206/thumb-Corsair-Vengeance-M95-612.png", 'image1' => "https://www.gamergear.net/content/product/206/thumb-Corsair-Vengeance-M95-610.png", 'image2' => "https://www.gamergear.net/content/product/206/thumb-Corsair-Vengeance-M95-611.png", 'image3' => "https://www.gamergear.net/content/product/206/thumb-Corsair-Vengeance-M95-612.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 40, 'cart_id' => null,
            'title' => "Dark Core RGB",
            'content' => "The Dark Core RGB by Corsair uses an Optical sensor, providing a DPI/CPI range of 100 DPI - 16,000 DPI.. It uses a USB Wired / Wireless connection with a 1.8m Braided Fiber cable. It weighs in at 128g grams with the cable and is approximately 126.8 x 89.2 x 43.2mm (LxWxH).",
            'weight' => 128, 'height' => 43, 'width' => 89, 'length' => 126, 'stock' => 30, 'price' => 20,
            'imageMain' => "https://www.gamergear.net/content/product/1341/thumb-DARK_CORE_RGB_01.png", 'image1' => "https://www.gamergear.net/content/product/1341/thumb-DARK_CORE_RGB_02_CYAN.png", 'image2' => "https://www.gamergear.net/content/product/1341/thumb-DARK_CORE_RGB_03_RED.png", 'image3' => "https://www.gamergear.net/content/product/1341/thumb-DARK_CORE_RGB_04.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 40, 'cart_id' => null,
            'title' => "Ironclaw RGB Wireless",
            'content' => "The Ironclaw RGB Wireless by Corsair uses an Optical sensor from Pixart,  the PMW3391, providing a DPI/CPI range of 18,000 DPI. It uses a Wireless, Wired connection with a 1.8m Braided Fiber cable. It weighs in at 130g without cable.",
            'weight' => 0, 'height' => 44, 'width' => 80, 'length' => 130, 'stock' => 32, 'price' => 102,
            'imageMain' => "https://www.gamergear.net/content/product/2019/08/1632/thumb-Ironclaw-RGB-Wireless-01.jpg", 'image1' => "https://www.gamergear.net/content/product/2019/08/1632/thumb-Ironclaw-RGB-Wireless-02.jpg", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 5, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 14, 'cart_id' => null,
            'title' => "Gila",
            'content' => "The Gila by Genius uses a Laser sensor from Avago, specifically the A9800, providing a DPI/CPI range of 200 dpi to 8200 dpi. This results in a tracking speed of  150 ips, and a maximum acceleration of 30Gs. It uses a USB gold plated connection with a 1.8m, braided cable. It weighs in at 197g grams with the cable, has Yes, 4 x  4.5g weights and is approximately 114 x 72 x 44mm (LxWxH).",
            'weight' => 197, 'height' => 44, 'width' => 72, 'length' => 114, 'stock' => 3, 'price' => 27,
            'imageMain' => "https://www.gamergear.net/content/product/304/thumb-Genius-Gila-1288.jpg", 'image1' => "https://www.gamergear.net/content/product/304/thumb-Genius-Gila-1289.jpg", 'image2' => "https://www.gamergear.net/content/product/304/thumb-Genius-Gila-1290.jpg", 'image3' => "https://www.gamergear.net/content/product/304/thumb-Genius-Gila-1291.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 18, 'cart_id' => null,
            'title' => "M.O.U.S. 9",
            'content' => "The M.O.U.S. 9 by MadCatz uses a Laser sensor, providing a DPI/CPI range of 990dpi, and a maximum acceleration of 8G. It uses a Bluetooth - 10m connection.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 16, 'price' => 69,
            'imageMain' => "https://www.gamergear.net/content/product/359/thumb-MadCatz-M.o.u.s.-9-2808.jpg", 'image1' => "https://www.gamergear.net/content/product/359/thumb-MadCatz-M.o.u.s.-9-2808.jpg", 'image2' => "https://www.gamergear.net/content/product/359/thumb-MadCatz-M.o.u.s.-9-2809.jpg", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 8, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 18, 'cart_id' => null,
            'title' => "R.A.T. 5",
            'content' => "The R.A.T. 5 by MadCatz uses a Laser sensor from Philips, specifically the PLN 2031 / PLN 2032, providing a DPI/CPI range of 100 - 5600dpi (in 25dpi steps). This results in a tracking speed of 6 m/sec, and a maximum acceleration of 50G. It uses a USB, gold plated connection with a braided cable.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 8, 'price' => 132,
            'imageMain' => "https://www.gamergear.net/content/product/364/thumb-MadCatz-R.a.t.-5-2279.jpg", 'image1' => "https://www.gamergear.net/content/product/364/thumb-MadCatz-R.a.t.-5-2280.jpg", 'image2' => "https://www.gamergear.net/content/product/364/thumb-MadCatz-R.a.t.-5-2281.jpg", 'image3' => "https://www.gamergear.net/content/product/364/thumb-MadCatz-R.a.t.-5-2282.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 6, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 51, 'cart_id' => null,
            'title' => "G700s",
            'content' => "The G700s by Logitech uses a Laser sensor from Avago, specifically the ADNS-S9808, providing a DPI/CPI range of 200 - 8200 dpi (increments of 200dpi). This results in a tracking speed of up to 165 inches, and a maximum acceleration of 30 G. It uses a Wireless, USB connection. It weighs in at 147g grams with the cable and is approximately 129 x 84 x 47mm (LxWxH).",
            'weight' => 147, 'height' => 47, 'width' => 84, 'length' => 129, 'stock' => 15, 'price' => 122,
            'imageMain' => "https://www.gamergear.net/content/product/282/thumb-Logitech-G700s-1093.png", 'image1' => "https://www.gamergear.net/content/product/282/thumb-Logitech-G700s-1094.png", 'image2' => "https://www.gamergear.net/content/product/282/thumb-Logitech-G700s-1095.png", 'image3' => "https://www.gamergear.net/content/product/282/thumb-Logitech-G700s-1096.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 4, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 51, 'cart_id' => null,
            'title' => "G502 Proteus Core",
            'content' => "The G502 Proteus Core by Logitech uses an Optical sensor from Pixart, specifically the PMW3366DM-VWQU, providing a DPI/CPI range of from 200 DPI to 12000 DPI . This is combined with a 32-bit microcontroller. This results in a tracking speed of 300 ips, and a maximum acceleration of 40G. It uses a USB connection with a 1.83m, Braided cable cable. It weighs in at 168 g grams with the cable and 121 g without the cable, has 5 x 3.6g weights and is approximately 132 x 75 x 40mm (LxWxH).",
            'weight' => 168, 'height' => 40, 'width' => 75, 'length' => 132, 'stock' => 18, 'price' => 137,
            'imageMain' => "https://www.gamergear.net/content/product/690/thumb-Logitech-G502-Proteus-Core-4.jpg", 'image1' => "https://www.gamergear.net/content/product/690/thumb-Logitech-G502-Proteus-Core-2568.jpg", 'image2' => "https://www.gamergear.net/content/product/690/thumb-Logitech-G502-Proteus-Core-2569.jpg", 'image3' => "https://www.gamergear.net/content/product/690/thumb-Logitech-G502-Proteus-Core-2570.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 51, 'cart_id' => null,
            'title' => "MX Master",
            'content' => "The MX Master by Logitech uses a Laser sensor, specifically the PMW3806, providing a DPI/CPI range of 400 dpi to 1600 dpi (increments of 200 dpi).. It uses a 2.4 GHz (Unifying) and Bluetooth 4.0 connection with a Micro-USB cable for recharging cable. It weighs in at 145g grams with the cable and is approximately 126 x 85 x 48mm (LxWxH).",
            'weight' => 145, 'height' => 48, 'width' => 85, 'length' => 126, 'stock' => 15, 'price' => 22,
            'imageMain' => "https://www.gamergear.net/content/product/910/thumb-Logitech-Mx-Master-3294.jpg", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 8, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 51, 'cart_id' => null,
            'title' => "G903 LightSpeed Hero",
            'content' => "The G903 LightSpeed Hero by Logitech uses an Optical sensor, specifically the  HERO 16K, providing a DPI/CPI range of 100 - 16,000 dpi. This is combined with a 32-bit ARM. This results in a tracking speed of 400ips, and a maximum acceleration of 40G. It uses a USB, Wireless connection with a 1.8 m cable. It weighs in at 110 g without the cable and is approximately 130 x 67 x 40 mm (LxWxH).",
            'weight' => 0, 'height' => 40, 'width' => 67, 'length' => 130, 'stock' => 1, 'price' => 105,
            'imageMain' => "https://www.gamergear.net/content/product/2019/09/1667/thumb-G903-Lightspeed-Hero-02.jpg", 'image1' => "https://www.gamergear.net/content/product/2019/09/1667/thumb-G903-Lightspeed-Hero-02.jpg", 'image2' => "https://www.gamergear.net/content/product/2019/09/1667/thumb-G903-Lightspeed-Hero-03.jpg", 'image3' => "https://www.gamergear.net/content/product/2019/09/1667/thumb-G903-Lightspeed-Hero-04.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 4, 'article_type_id' => 5, 'article_purpose_id' => 1,'brand_id' => 58, 'cart_id' => null,
            'title' => "Deathstalker",
            'content' => "The Deathstalker by Razer is a Full sized keyboard with 104 keys, which uses Chiclet-style switches. The Deathstalker keyboard uses a USB connection, with a braided. It is supported by Synapse 2.0 software. And has Green backlighting.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 38, 'price' => 51,
            'imageMain' => "https://www.gamergear.net/content/product/32/thumb-Razer-Deathstalker-1434.png", 'image1' => "https://www.gamergear.net/content/product/32/thumb-Razer-Deathstalker-1435.png", 'image2' => "https://www.gamergear.net/content/product/32/thumb-Razer-Deathstalker-1436.png", 'image3' => "https://www.gamergear.net/content/product/33/thumb-Razer-Deathstalker-Ultimate-1431.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 14, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 58, 'cart_id' => null,
            'title' => "Blackwidow Ultimate Stealth",
            'content' => "The Blackwidow Ultimate Stealth by Razer is a Full sized keyboard with 109 keys, which uses mechanical keys with 45g actuation force switches. The Blackwidow Ultimate Stealth keyboard uses a USB connection, with a Braided fibre cable. It is supported by Synapse 2.0 software. And has Green backlighting with Adjustable brightness effects. It weighs in at 1500g, and is 475 x 171 x 30mm [LxWxH].",
            'weight' => 1500, 'height' => 30, 'width' => 171, 'length' => 475, 'stock' => 6, 'price' => 57,
            'imageMain' => "https://www.gamergear.net/content/product/49/thumb-Razer-Blackwidow-Ultimate-Stealth-1419.png", 'image1' => "https://www.gamergear.net/content/product/49/thumb-Razer-Blackwidow-Ultimate-Stealth-1420.png", 'image2' => "https://www.gamergear.net/content/product/49/thumb-Razer-Blackwidow-Ultimate-Stealth-1421.png", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 14, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 58, 'cart_id' => null,
            'title' => "Huntsman Elite",
            'content' => "The Huntsman Elite by Razer is a Full sized keyboard with 109 keys, which uses Opto-Mechanical switches, rated for 100 million keystrokes. The keyboard has dedicated media keys. The Huntsman Elite keyboard uses a USB connection, with a 1.8m Braided Fiber cable. It is supported by Synapse 3 software. And has 16.8m per key backlighting with Chroma effects. It weighs in at 1.7kg, and is x 44.7 x 35.5mm [LxWxH].",
            'weight' => 1, 'height' => 35, 'width' => 44, 'length' => 0, 'stock' => 8, 'price' => 147,
            'imageMain' => "https://www.gamergear.net/content/product/1430/thumb-Huntsman-Elite-001.jpg", 'image1' => "https://www.gamergear.net/content/product/1430/thumb-Huntsman-Elite-002.jpg", 'image2' => "https://www.gamergear.net/content/product/1430/thumb-Huntsman-Elite-003.jpg", 'image3' => "https://www.gamergear.net/content/product/1430/thumb-Huntsman-Elite-004.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 6, 'article_type_id' => 5, 'article_purpose_id' => 3,'brand_id' => 58, 'cart_id' => null,
            'title' => "BlackWidow Elite",
            'content' => "The BlackWidow Elite by Razer is a Full sized keyboard with 108 keys, which uses Razer Mechanical Switches. The keyboard has dedicated media keys. The BlackWidow Elite keyboard uses a USB connection. It is supported by Razer Synapse 3 software. And has Razer Chroma customizable backlighting. And is 444.5 x 152.4 mm [LxWxH].",
            'weight' => 0, 'height' => 0, 'width' => 152, 'length' => 444, 'stock' => 30, 'price' => 99,
            'imageMain' => "https://www.gamergear.net/content/product/1436/thumb-BlackWidow-Elite-01.jpg", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 4, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 4, 'cart_id' => null,
            'title' => "Cerberus MKII",
            'content' => "The Cerberus MKII by ASUS is a Full sized keyboard with 104 keys, which uses Membrane with rubber dome switches. The Cerberus MKII keyboard uses a USB gold-plated connection, with a 2m Braided cable. And has Multi-colors (with 343 color combinations) backlighting. It weighs in at 1100 g, and is 471 x 186 x 41 mm [LxWxH].",
            'weight' => 1100, 'height' => 41, 'width' => 186, 'length' => 471, 'stock' => 4, 'price' => 118,
            'imageMain' => "https://www.gamergear.net/content/product/1266/thumb_cerberus-MKII-001.jpg", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 10, 'article_type_id' => 5, 'article_purpose_id' => 1,'brand_id' => 18, 'cart_id' => null,
            'title' => "S.T.R.I.K.E. 5",
            'content' => "The S.T.R.I.K.E. 5 by MadCatz is a  Full sized keyboard with 110 keys, which uses membrane, 60g of actuation force switches. The S.T.R.I.K.E. 5 keyboard uses a USB connection. It is supported by Yes software. And has 16 million color RGB backlighting backlighting.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 36, 'price' => 134,
            'imageMain' => "https://www.gamergear.net/content/product/367/thumb-MadCatz-S.t.r.i.k.e.-5-2795.png", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 14, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 51, 'cart_id' => null,
            'title' => "G510s",
            'content' => "The G510s by Logitech is a Full sized keyboard with 122 keys. The keyboard has dedicated media keys. The G510s keyboard uses a USB connection, with a 2 m cable. It is supported by Logitech Gaming Software software. And has RGB backlighting.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 29, 'price' => 60,
            'imageMain' => "https://www.gamergear.net/content/product/289/thumb-Logitech-G510s-1109.png", 'image1' => "https://www.gamergear.net/content/product/289/thumb-Logitech-G510s-1110.png", 'image2' => "https://www.gamergear.net/content/product/289/thumb-Logitech-G510s-1111.png", 'image3' => "https://www.gamergear.net/content/product/289/thumb-Logitech-G510s-1112.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 5, 'article_purpose_id' => 3,'brand_id' => 51, 'cart_id' => null,
            'title' => "G810 Orion Spectrum",
            'content' => "The G810 Orion Spectrum by Logitech is a Full sized keyboard with 104 keys, which uses Romer-G Mechanical Switches. The G810 Orion Spectrum keyboard uses a USB connection, with a 1.8 m cable. It is supported by Logitech Gaming Software software. And has per key, 16.8 million colours backlighting. It weighs in at w/o cable: 1180 g, and is 443.5 x 343 x 153 mm [LxWxH].",
            'weight' => 0, 'height' => 153, 'width' => 343, 'length' => 443, 'stock' => 23, 'price' => 28,
            'imageMain' => "https://www.gamergear.net/content/product/1055/thumb_Logitech-G810-Orion-Spectrum.png", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 5, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 51, 'cart_id' => null,
            'title' => "G910 ORION SPARK RGB",
            'content' => "The G910 ORION SPARK RGB by Logitech is a Full sized keyboard with 113 keys, which uses Romer-G switches rated for 70 million presses. The G910 ORION SPARK RGB keyboard uses a USB connection, with a 1.8m cable. It is supported by Logitech Gaming Software software. And has 16.8M Colors backlighting with Via Software effects. It weighs in at 1.5KG, and is 243.5 x 505 x 35.5mm [LxWxH].",
            'weight' => 1, 'height' => 35, 'width' => 505, 'length' => 243, 'stock' => 6, 'price' => 32,
            'imageMain' => "https://www.gamergear.net/content/product/781/thumb-Logitech-G910-Orion-Spark-Rgb-2796.png", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 5, 'article_type_id' => 5, 'article_purpose_id' => 1,'brand_id' => 40, 'cart_id' => null,
            'title' => "Vengeance K95",
            'content' => "The Vengeance K95 by Corsair is a Full sized keyboard with 134 keys, which uses Cherry MX Red switches. The Vengeance K95 keyboard uses a USB connection. It is supported by Corsair Gaming Software. And has White backlighting with adjustable brightness and key-by-key programmable effects. It weighs in at 1.35kg (without wrist rest), and is 502 x 165 x 38 mm (without wrist rest) [LxWxH].",
            'weight' => 1, 'height' => 38, 'width' => 165, 'length' => 502, 'stock' => 2, 'price' => 30,
            'imageMain' => "https://www.gamergear.net/content/product/216/thumb-Corsair-Vengeance-K95-524.png", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 2, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 40, 'cart_id' => null,
            'title' => "K57 RGB Wireless",
            'content' => "The K57 RGB Wireless by Corsair is a Full sized keyboard with 110 keys, which uses Rubber Dome switches. The keyboard has dedicated media keys. The K57 RGB Wireless keyboard uses a USB, Wireless, Wired connection. It is supported by Corsair iCUE software. And has per-key RGB backlighting. It weighs in at 0.95kg.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 14, 'price' => 149,
            'imageMain' => "https://www.gamergear.net/content/product/2019/08/1631/thumb-K57-RGB-Wireless-01.jpg", 'image1' => "https://www.gamergear.net/content/product/2019/08/1631/thumb-K57-RGB-Wireless-02.jpg", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 7, 'cart_id' => null,
            'title' => "Quick Fire Stealth",
            'content' => "The Quick Fire Stealth by CoolerMaster, which uses CHERRY Blue / Red / Brown / Green switches. The Quick Fire Stealth keyboard uses a gold plated USB / PS/2 adapter which is Removable, with a braided cable. It weighs in at 940g , and is 355 x 135 x 35 mm [LxWxH].",
            'weight' => 940, 'height' => 35, 'width' => 135, 'length' => 355, 'stock' => 16, 'price' => 121,
            'imageMain' => "https://www.gamergear.net/content/product/76/thumb-CM-Storm-Quick-Fire-Stealth-758.jpg", 'image1' => "https://www.gamergear.net/content/product/76/thumb-CM-Storm-Quick-Fire-Stealth-756.jpg", 'image2' => "https://www.gamergear.net/content/product/76/thumb-CM-Storm-Quick-Fire-Stealth-757.jpg", 'image3' => "https://www.gamergear.net/content/product/76/thumb-CM-Storm-Quick-Fire-Stealth-758.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 5, 'article_purpose_id' => 2,'brand_id' => 7, 'cart_id' => null,
            'title' => "CK550",
            'content' => "The CK550 by CoolerMaster is a Full sized keyboard with 104 keys, which uses Gateron Blue, Brown, Red switches. The keyboard has media keys which are accessible via function keys. The CK550 keyboard uses a USB 2.0 connection, with a 1.8m Rubberized cable. It is supported by CoolerMaster Portal software. And has RGB backlighting. It weighs in at 850 g, and is 460 x 135 x 41 mm [LxWxH].",
            'weight' => 850, 'height' => 41, 'width' => 135, 'length' => 460, 'stock' => 32, 'price' => 140,
            'imageMain' => "https://www.gamergear.net/content/product/1515/thumb-CK550-03.jpg", 'image1' => "https://www.gamergear.net/content/product/1515/thumb-CK550-02.jpg", 'image2' => "https://www.gamergear.net/content/product/1515/thumb-CK550-03.jpg", 'image3' => "https://www.gamergear.net/content/product/1515/thumb-CK550-04.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 5, 'article_purpose_id' => 1,'brand_id' => 7, 'cart_id' => null,
            'title' => "MK110",
            'content' => "The MK110 by CoolerMaster is a Full sized keyboard with 104 keys, which uses Mem-chanical switches. The keyboard has media keys which are accessible via function keys. The MK110 keyboard uses a USB connection, with a 1.8m, Rubberized cable. And has  6-zone RGB backlighting. It weighs in at 1022g, and is 440 x 134 x 40.3 mm [LxWxH].",
            'weight' => 1022, 'height' => 40, 'width' => 134, 'length' => 440, 'stock' => 2, 'price' => 14,
            'imageMain' => "https://www.gamergear.net/content/product/2020/01/1745/thumb-MK110-01.jpg", 'image1' => "https://www.gamergear.net/content/product/2020/01/1745/thumb-MK110-02.jpg", 'image2' => "https://www.gamergear.net/content/product/2020/01/1745/thumb-MK110-03.jpg", 'image3' => "https://www.gamergear.net/content/product/2020/01/1745/thumb-MK110-04.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 11, 'article_type_id' => 5, 'article_purpose_id' => 1,'brand_id' => 59, 'cart_id' => null,
            'title' => "Vulcan 122 AIMO",
            'content' => "The Vulcan 122 AIMO by Roccat is a Full sized keyboard with 108 keys, which uses Titan Switches switches. The keyboard has dedicated media keys. The Vulcan 122 AIMO keyboard uses a USB connection, with a 1.8m cable. It is supported by ROCCAT Swarm software. And has RGB per-key - 16.8m colors backlighting. It weighs in at 1150 g, and is 462 x 235 x 32 mm [LxWxH].",
            'weight' => 1150, 'height' => 32, 'width' => 235, 'length' => 462, 'stock' => 2, 'price' => 145,
            'imageMain' => "https://www.gamergear.net/content/product/2019/09/1653/thumb-Vulcan-122-Aimo-01.jpg", 'image1' => "https://www.gamergear.net/content/product/2019/09/1653/thumb-Vulcan-122-Aimo-01.jpg", 'image2' => "https://www.gamergear.net/content/product/2019/09/1653/thumb-Vulcan-122-Aimo-02.jpg", 'image3' => "https://www.gamergear.net/content/product/2019/09/1653/thumb-Vulcan-122-Aimo-03.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 11, 'article_type_id' => 5, 'article_purpose_id' => 3,'brand_id' => 59, 'cart_id' => null,
            'title' => "Ryos MK FX",
            'content' => "The Ryos MK FX by Roccat is a Full sized keyboard with 111 keys, which uses CHERRY MX switches. The Ryos MK FX keyboard uses a USB connection, with a 1.8m braided cable. It is supported by Roccat Swarm software. And has Per Key 16.8 million  backlighting. It weighs in at 1600 g, and is 508 x 234 x 44 mm [LxWxH].",
            'weight' => 1600, 'height' => 44, 'width' => 234, 'length' => 508, 'stock' => 12, 'price' => 12,
            'imageMain' => "https://www.gamergear.net/content/product/1043/thumb_ryos-mk-fx-001.jpg", 'image1' => "https://www.gamergear.net/content/product/1043/thumb_ryos-mk-fx-002.jpg", 'image2' => "https://www.gamergear.net/content/product/1043/thumb_ryos-mk-fx-003.jpg", 'image3' => "https://www.gamergear.net/content/product/1043/thumb_ryos-mk-fx-004.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 11, 'article_type_id' => 25, 'article_purpose_id' => 1,'brand_id' => 4, 'cart_id' => null,
            'title' => "Orion",
            'content' => "The Orion by ASUS, which uses a 50 mm Neodymium driver. It uses a 3.5 mm connection with a 2.5m Braided cable. This delivers a frequency response of 20 ~ 20000 Hz and a sensitivity of 100 dB. And only weighs in at 268 g.",
            'weight' => 268, 'height' => null, 'width' => null, 'length' => null, 'stock' => 25, 'price' => 44,
            'imageMain' => "https://www.gamergear.net/content/product/259/thumb-ASUS-Orion-879.jpg", 'image1' => "https://www.gamergear.net/content/product/259/thumb-ASUS-Orion-878.jpg", 'image2' => "https://www.gamergear.net/content/product/259/thumb-ASUS-Orion-879.jpg", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 11, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 4, 'cart_id' => null,
            'title' => "Orion PRO",
            'content' => "The Orion PRO by ASUS is a 7.1 channel gaming headset, which uses a 50 mm Neodymium driver. It uses a USB, 3.5 mm connection with a 2.5 m cable. This delivers a frequency response of 20 ~ 20000 Hz and a sensitivity of 100 dB. And only weighs in at 268 g.",
            'weight' => 268, 'height' => null, 'width' => null, 'length' => null, 'stock' => 14, 'price' => 10,
            'imageMain' => "https://www.gamergear.net/content/product/260/thumb-ASUS-Orion-Pro-881.jpg", 'image1' => "https://www.gamergear.net/content/product/260/thumb-ASUS-Orion-Pro-881.jpg", 'image2' => "https://www.gamergear.net/content/product/260/thumb-ASUS-Orion-Pro-882.jpg", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 4, 'cart_id' => null,
            'title' => "ROG Delta",
            'content' => "The ROG Delta by ASUS, which uses a 50 mm Neodymium driver. It uses a USB-C, USB 2.0 connection with a USB-C: 1.5m; USB 2.0: 1m cable. This delivers a frequency response of 20 ~ 40000 Hz. It also has a Uni-directional microphone with a frequency response of 100 ~ 10000 Hz and a sensitivity of -40 dB. And only weighs in at 387 g.",
            'weight' => 387, 'height' => null, 'width' => null, 'length' => null, 'stock' => 35, 'price' => 86,
            'imageMain' => "https://www.gamergear.net/content/product/1481/thumb-ROG-Delta-01.jpg", 'image1' => "https://www.gamergear.net/content/product/1481/thumb-ROG-Delta-02.jpg", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 3, 'article_type_id' => 25, 'article_purpose_id' => 3,'brand_id' => 4, 'cart_id' => null,
            'title' => "ROG Strix Wireless",
            'content' => "The ROG Strix Wireless by ASUS is a 7.1 virtual surround sound channel gaming headset, which uses a 60 mm Neodymium magnet driver. It uses a USB (wireless 2.4GHz),  3.5 mm connection with a Braided fibre 1.5m cable. This delivers a frequency response of 20 ~ 20000 Hz and a sensitivity of 98 dB. It also has a Uni-directional microphone with a frequency response of 50 ~ 16000 Hz and a sensitivity of -40 dB. And only weighs in at 350 g.",
            'weight' => 350, 'height' => null, 'width' => null, 'length' => null, 'stock' => 19, 'price' => 99,
            'imageMain' => "https://www.gamergear.net/content/product/1078/thumb_ROG-Strix-Wireless-001.png", 'image1' => "https://www.gamergear.net/content/product/1078/thumb_ROG-Strix-Wireless-002.png", 'image2' => "https://www.gamergear.net/content/product/1078/thumb_ROG-Strix-Wireless-003.png", 'image3' => "https://www.gamergear.net/content/product/1078/thumb_ROG-Strix-Wireless-004.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 7, 'cart_id' => null,
            'title' => "Ceres 400",
            'content' => "The Ceres 400 by CoolerMaster is a 2 channel gaming headset, which uses a 40mm x 7.5 mm(H) driver. It uses a 3.5 mm connection with a 2.5m cable. This delivers a frequency response of 20 - 20,000 Hz and a sensitivity of 108 dB ± 4 dB. It also has an Omni-Directional microphone with a frequency response of 100 - 10,000 Hz and a sensitivity of -30 ± 3 dB.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 15, 'price' => 142,
            'imageMain' => "https://www.gamergear.net/content/product/99/thumb-CM-Storm-Ceres-400-820.jpg", 'image1' => "https://www.gamergear.net/content/product/99/thumb-CM-Storm-Ceres-400-819.jpg", 'image2' => "https://www.gamergear.net/content/product/99/thumb-CM-Storm-Ceres-400-820.jpg", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 25, 'article_purpose_id' => 1,'brand_id' => 7, 'cart_id' => null,
            'title' => "Sirus S - 5.1",
            'content' => "The Sirus S - 5.1 by CoolerMaster is a 5.1 channel gaming headset, which uses an F/R/C: 30mm Sub: 40mm driver. It uses a USB connection. This delivers a frequency response of 10Hz - 20,000Hz and sensitivity of >105dB. It also has a uni-directional microphone with a frequency response of 100Hz - 10,000 Hz and a sensitivity of -44 dB ± 3dB.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 8, 'price' => 105,
            'imageMain' => "https://www.gamergear.net/content/product/102/thumb-CM-Storm-Sirus-S-5.1-831.jpg", 'image1' => "https://www.gamergear.net/content/product/102/thumb-CM-Storm-Sirus-S-5.1-831.jpg", 'image2' => "https://www.gamergear.net/content/product/102/thumb-CM-Storm-Sirus-S-5.1-832.jpg", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 10, 'article_type_id' => 25, 'article_purpose_id' => 3,'brand_id' => 7, 'cart_id' => null,
            'title' => "MasterPulse MH750",
            'content' => "The MasterPulse MH750 by CoolerMaster, which uses a 44mm driver driver. It uses a USB, Gold Plated connection with a 2m cable. This delivers a frequency response of 20 ~ 20,000Hz and a sensitivity of 118 dB +/-3 dB. It also has a Uni-Directional microphone with a frequency response of 100 ~ 10,000Hz and a sensitivity of -34 +/-3dB.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 33, 'price' => 132,
            'imageMain' => "https://www.gamergear.net/content/product/1355/thumb-mh750-01.jpg", 'image1' => "https://www.gamergear.net/content/product/1355/thumb-mh750-02.jpg", 'image2' => "https://www.gamergear.net/content/product/1355/thumb-mh750-03.jpg", 'image3' => "https://www.gamergear.net/content/product/1355/thumb-mh750-04.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 2, 'article_type_id' => 25, 'article_purpose_id' => 1,'brand_id' => 16, 'cart_id' => null,
            'title' => "CloudX",
            'content' => "The CloudX by Hyper X, which uses a 53mm driver. It uses a 3.5mm plug (4 pole) + PC extension cable - 3.5mm stereo and mic plugs connection with a 1.3m + PC extension cable (2m) cable. This delivers a frequency response of 15Hz - 25,000 Hz and a sensitivity of 98dBSPL/mW at 1kHz. It also has a Uni-directional, Noise-canceling, Electret condenser microphone with a frequency response of 50Hz-18,000 Hz and a sensitivity of -39dBV (0dB=1V/Pa,1kHz). And only weighs in at 322g.",
            'weight' => 322, 'height' => null, 'width' => null, 'length' => null, 'stock' => 0, 'price' => 77,
            'imageMain' => "https://www.gamergear.net/content/product/1215/thumb_HyperX-CloudX-001.jpg", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 5, 'article_type_id' => 25, 'article_purpose_id' => 1,'brand_id' => 16, 'cart_id' => null,
            'title' => "Cloud",
            'content' => "The Cloud by Hyper X, which uses a 53mm driver. It uses a mini stereo jack plug (3.5 mm) connection with a 1m + 2m extension + 10cm iPhone  cable. This delivers a frequency response of 15Hz - 25,000 Hz and a sensitivity of 98 ± 3dB. It also has a condenser , cardioid microphone with a frequency response of 100 - 12,000 Hz. And only weighs in at 350g.",
            'weight' => 350, 'height' => null, 'width' => null, 'length' => null, 'stock' => 29, 'price' => 124,
            'imageMain' => "https://www.gamergear.net/content/product/964/thumb_HyperX-cloud-001.png", 'image1' => "https://www.gamergear.net/content/product/964/thumb_HyperX-cloud-002.png", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 18, 'cart_id' => null,
            'title' => "F.R.E.Q. 5",
            'content' => "The F.R.E.Q. 5 by MadCatz, which uses a 50mm Neodymium driver. It uses a USB, 3.5mm connection with a 6.6ft USB / 3.3ft 3.5mm cable. This delivers a frequency response of 20Hz - 20kHz.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 28, 'price' => 85,
            'imageMain' => "https://www.gamergear.net/content/product/357/thumb-MadCatz-F.r.e.q.-5-2784.jpg", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 10, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 40, 'cart_id' => null,
            'title' => "Vengeance 1400",
            'content' => "The Vengeance 1400 by Corsair is a 2 channel gaming headset, which uses a 50mm driver. It uses a 2 x 3.5mm connection with a 3m cable. This delivers a frequency response of 20Hz to 20kHz and a sensitivity of 95dB (A-weighted). It also has a Unidirectional noise-cancelling condenser microphone with a frequency response of 100Hz to 10kHz and a sensitivity of -41dB (+/-3dB).",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 0, 'price' => 32,
            'imageMain' => "https://www.gamergear.net/content/product/602/thumb-Corsair-Vengeance-1400-2071.png", 'image1' => "https://www.gamergear.net/content/product/602/thumb-Corsair-Vengeance-1400-2072.png", 'image2' => "null", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 9, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 40, 'cart_id' => null,
            'title' => "HS60",
            'content' => "The HS60 by Corsair, which uses a 50mm driver. It uses a 3.5mm, USB 7.1 surround sound adapter connection This delivers a frequency response of 20Hz - 20 kHz and a sensitivity of 111dB (+/-3dB). It also has a Unidirectional noise cancelling microphone with a frequency response of 100Hz to 10kHz and a sensitivity of -40dB (+/-3dB).",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 14, 'price' => 61,
            'imageMain' => "https://www.gamergear.net/content/product/1500/HS60-Carbon-06-250x250.jpg", 'image1' => "https://www.gamergear.net/content/product/1500/HS60-Carbon-02-250x250.jpg", 'image2' => "https://www.gamergear.net/content/product/1500/HS60-Carbon-03-250x250.jpg", 'image3' => "https://www.gamergear.net/content/product/1500/HS60-Carbon-06-250x250.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 25, 'article_purpose_id' => 3,'brand_id' => 30, 'cart_id' => null,
            'title' => "Kunai",
            'content' => "The Kunai by Tritton is a 2 channel gaming headset, which uses a 40mm, Neodymium driver. It uses a 3.5mm connection with a 3m cable. This delivers a frequency response of 20Hz - 20kHz.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 0, 'price' => 85,
            'imageMain' => "https://www.gamergear.net/content/product/418/thumb-Tritton-Kunai-1262.png", 'image1' => "https://www.gamergear.net/content/product/418/thumb-Tritton-Kunai-1263.png", 'image2' => "https://www.gamergear.net/content/product/418/thumb-Tritton-Kunai-1264.png", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 2, 'article_type_id' => 25, 'article_purpose_id' => 1,'brand_id' => 58, 'cart_id' => null,
            'title' => "Electra",
            'content' => "Hit the streets fearlessly when you’ve got your music and mobile gaming audio powered by the Razer Electra. Hear the high scores racking up on your smartphone or the thumping bass of a rocking song in absolute crisp clarity as the slick headphones deliver every sound and note with great depth and balance.",
            'weight' => 284, 'height' => null, 'width' => null, 'length' => null, 'stock' => 37, 'price' => 65,
            'imageMain' => "https://www.gamergear.net/content/product/43/thumb-Razer-Electra-500.png", 'image1' => "https://www.gamergear.net/content/product/43/thumb-Razer-Electra-498.png", 'image2' => "https://www.gamergear.net/content/product/43/thumb-Razer-Electra-499.png", 'image3' => "https://www.gamergear.net/content/product/43/thumb-Razer-Electra-500.png",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 5, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 58, 'cart_id' => null,
            'title' => "Kraken Pro",
            'content' => "Introducing the Razer Kraken Pro, a gaming headset fully focused on ergonomics for the head. Weight, functionality and performance were the key variables identified and perfectly balanced for the most comfortable gaming headset. Ever.",
            'weight' => 293, 'height' => null, 'width' => null, 'length' => null, 'stock' => 13, 'price' => 15,
            'imageMain' => "https://www.gamergear.net/content/product/41/thumb-Razer-Kraken-Pro-490.png", 'image1' => "https://www.gamergear.net/content/product/41/thumb-Razer-Kraken-Pro-490.png", 'image2' => "https://www.gamergear.net/content/product/41/thumb-Razer-Kraken-Pro-491.png", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 14, 'article_type_id' => 25, 'article_purpose_id' => 2,'brand_id' => 59, 'cart_id' => null,
            'title' => "Noz",
            'content' => "The Noz by Roccat is a Stereo channel gaming headset, which uses a 50mm Neodymium  driver and a Detachable Microphone. It uses a dual plug 3.5mm (3-pin) connection with a 2.45m cable. This delivers a frequency response of 10 ~ 20000Hz and a sensitivity of 112dB. And only weighs in at 210 g.",
            'weight' => 210, 'height' => null, 'width' => null, 'length' => null, 'stock' => 0, 'price' => 24,
            'imageMain' => "https://www.gamergear.net/content/product/2019/09/1654/thumb-Noz-01.jpg", 'image1' => "https://www.gamergear.net/content/product/2019/09/1654/thumb-Noz-02.jpg", 'image2' => "https://www.gamergear.net/content/product/2019/09/1654/thumb-Noz-03.jpg", 'image3' => "null",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 6, 'article_type_id' => 25, 'article_purpose_id' => 3,'brand_id' => 59, 'cart_id' => null,
            'title' => "Kave 5.1",
            'content' => "The Kave 5.1 by Roccat is a 5.1 channel gaming headset, which uses a 40mm driver. It uses a 4 x 3.5mm, USB connection with a 3,4m total (2,0m Remote > PC) cable. This delivers a frequency response of 20 - 20,000Hz and a sensitivity of 114 ± 3dB. It also has an omnidirectional microphone and a sensitivity of 20 - 18,000Hz.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 40, 'price' => 141,
            'imageMain' => "https://www.gamergear.net/content/product/202/thumb-Roccat-Kave-5.1-1362.jpg", 'image1' => "https://www.gamergear.net/content/product/202/thumb-Roccat-Kave-5.1-1363.jpg", 'image2' => "https://www.gamergear.net/content/product/202/thumb-Roccat-Kave-5.1-1364.jpg", 'image3' => "https://www.gamergear.net/content/product/202/thumb-Roccat-Kave-5.1-1365.jpg",
            'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 12, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 1, 'cart_id' => null,
            'title' => "GM3",
            'content' => "The GM3 by 1st Player uses an Optical sensor from Avago, specifically the 3050, providing a DPI/CPI range of 1000 ~ 4000 DPI. This results in a tracking speed of 60ips, and a maximum acceleration of 20G. It uses a USB connection with a 1.78m Braided Fiber cable. The GM3 is considered to be an ambidextrous mouse.",
            'weight' => 0, 'height' => 35, 'width' => 65, 'length' => 120, 'stock' => 29, 'price' => 57,
            'imageMain' => "https://www.gamergear.net/content/product/1493/thumb-GM3-03.jpg", 'image1' => "https://www.gamergear.net/content/product/1493/thumb-GM3-02.jpg", 'image2' => "https://www.gamergear.net/content/product/1493/thumb-GM3-03.jpg", 'image3' => "https://www.gamergear.net/content/product/1493/thumb-GM3-04.jpg",
            'warranty' => 0, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 11, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 1, 'cart_id' => null,
            'title' => "GM3 plus",
            'content' => "The GM3 plus by 1st Player uses an Optical sensor from Avargo, specifically the 3050, providing a DPI/CPI range of 1000, 1500, 1750, 2000, 2500, 3500 dpi. This results in a tracking speed of 60ips, and a maximum acceleration of 30g. It uses a USB connection with a 1.8m cable. The GM3 plus is considered to be an ambidextrous mouse.  It weighs in at 134.5g grams with the cable and is approximately 125.7 x 57 x 39 mm (LxWxH).",
            'weight' => 134, 'height' => 39, 'width' => 57, 'length' => 125, 'stock' => 14, 'price' => 46,
            'imageMain' => "https://www.gamergear.net/content/product/1496/thumb-GM3-plus-02.jpg", 'image1' => "https://www.gamergear.net/content/product/1496/thumb-GM3-plus-02.jpg", 'image2' => "null", 'image3' => "null",
            'warranty' => 5, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 1, 'cart_id' => null,
            'title' => "Black.Sir BS300",
            'content' => "The Black.Sir BS300 by 1st Player uses an Optical sensor from Avargo, specifically the 3050, providing a DPI/CPI range of 4 Levels (500, 1000, 1500, 2000). This results in a tracking speed of 60 ips, and a maximum acceleration of 20g. It uses a USB connection with a 1.8m Braided cable. It weighs in at 127g grams with the cable and is approximately 118 x 63 x 38 mm (LxWxH).",
            'weight' => 127, 'height' => 38, 'width' => 63, 'length' => 118, 'stock' => 27, 'price' => 42,
            'imageMain' => "https://www.gamergear.net/content/product/1551/thumb-BS300-06.jpg", 'image1' => "https://www.gamergear.net/content/product/1551/thumb-BS300-02.jpg", 'image2' => "https://www.gamergear.net/content/product/1551/thumb-BS300-03.jpg", 'image3' => "https://www.gamergear.net/content/product/1551/thumb-BS300-04.jpg",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 3, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 1, 'cart_id' => null,
            'title' => "FD300",
            'content' => "The FD300 by 1st Player uses an Optical sensor from Avago, specifically the 3050, providing a DPI/CPI range of 4 Levels (500, 1000, 1500, 2000). This results in a tracking speed of 100ips, and a maximum acceleration of 20g. It uses a USB connection with a 1.7m cable. It weighs in at 172g grams with the cable and is approximately 126 x 66.5 x 40.5 mm (LxWxH).",
            'weight' => 172, 'height' => 40, 'width' => 66, 'length' => 126, 'stock' => 0, 'price' => 64,
            'imageMain' => "https://www.gamergear.net/content/product/1566/thumb-FD300-001.jpg", 'image1' => "null", 'image2' => "null", 'image3' => "null",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 1, 'cart_id' => null,
            'title' => "FD300 PRO",
            'content' => "The FD300 PRO by 1st Player uses an Optical sensor from Pixart, specifically the PMW 3325. This results in a tracking speed of 100ips, and a maximum acceleration of 20g. It uses a USB connection with a 1.8m cable. It weighs in at 172g grams with the cable and is approximately 126 x 66.5 x 40.5 mm (LxWxH).",
            'weight' => 172, 'height' => 40, 'width' => 66, 'length' => 126, 'stock' => 2, 'price' => 87,
            'imageMain' => "https://www.gamergear.net/content/product/1567/thumb-FD300-PRO-01.jpg", 'image1' => "https://www.gamergear.net/content/product/1567/thumb-FD300-PRO-02.jpg", 'image2' => "https://www.gamergear.net/content/product/1567/thumb-FD300-PRO-03.jpg", 'image3' => "https://www.gamergear.net/content/product/1567/thumb-FD300-PRO-05.jpg",
            'warranty' => 0, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 12, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 2, 'cart_id' => null,
            'title' => "Anker 8000",
            'content' => "The Anker 8000 by Anker uses a Laser sensor from Avago, specifically the ADNS-9800, providing a DPI/CPI range of 8200dpi. It uses a USB connection. It weighs in at 140g to 160g grams with the cable, has 8-piece weight tuning weights and is approximately 127 x 79 x 43 mm (LxWxH).",
            'weight' => 140, 'height' => 43, 'width' => 79, 'length' => 127, 'stock' => 13, 'price' => 87,
            'imageMain' => "https://www.gamergear.net/content/product/507/thumb-Anker-Anker-8000-1657.jpg", 'image1' => "https://www.gamergear.net/content/product/507/thumb-Anker-Anker-8000-1658.jpg", 'image2' => "https://www.gamergear.net/content/product/507/thumb-Anker-Anker-8000-1659.jpg", 'image3' => "https://www.gamergear.net/content/product/507/thumb-Anker-Anker-8000-1660.jpg",
            'warranty' => 2, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 2, 'cart_id' => null,
            'title' => "Anker 2000",
            'content' => "The Anker 2000 by Anker uses an Optical sensor, providing a DPI/CPI range of 500 / 1000 / 1500 / 2000 DPI. It uses a USB connection. It weighs in at 155g grams with the cable and is approximately 131 x 68 x 43 mm (LxWxH).",
            'weight' => 155, 'height' => 43, 'width' => 68, 'length' => 131, 'stock' => 26, 'price' => 15,
            'imageMain' => "https://www.gamergear.net/content/product/515/thumb-Anker-Anker-2000-1707.jpg", 'image1' => "https://www.gamergear.net/content/product/515/thumb-Anker-Anker-2000-1708.jpg", 'image2' => "https://www.gamergear.net/content/product/515/thumb-Anker-Anker-2000-1709.jpg", 'image3' => "https://www.gamergear.net/content/product/515/thumb-Anker-Anker-2000-1710.jpg",
            'warranty' => 0, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 3, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 2, 'cart_id' => null,
            'title' => "Anker 5000",
            'content' => "The Anker 5000 by Anker uses a Laser sensor, providing a DPI/CPI range of 5000 DPI.. It uses a USB connection. It weighs in at 140g - 170g grams with the cable, has 6 weights and is approximately 126 x 88 x 42mm (LxWxH).",
            'weight' => 140, 'height' => 42, 'width' => 88, 'length' => 126, 'stock' => 0, 'price' => 136,
            'imageMain' => "https://www.gamergear.net/content/product/516/thumb-Anker-Anker-5000-1711.jpg", 'image1' => "https://www.gamergear.net/content/product/516/thumb-Anker-Anker-5000-1712.jpg", 'image2' => "https://www.gamergear.net/content/product/516/thumb-Anker-Anker-5000-1713.jpg", 'image3' => "https://www.gamergear.net/content/product/516/thumb-Anker-Anker-5000-1714.jpg",
            'warranty' => 0, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 3, 'cart_id' => null,
            'title' => "Mikoyan FoxBat",
            'content' => "The Mikoyan FoxBat by Armaggeddon uses an Optical sensor from PixArt, specifically the PAW3395DK, providing a DPI/CPI range of 400, 800, 1600, 3200 CPI. This results in a tracking speed of 70IPS, and a maximum acceleration of 30G. It uses a USB connection with a 1.8m durable nylon cord cable.",
            'weight' => 0, 'height' => 38, 'width' => 123, 'length' => 70, 'stock' => 36, 'price' => 101,
            'imageMain' => "https://www.gamergear.net/content/product/605/thumb-Armaggeddon-Mikoyan-Foxbat-2083.png", 'image1' => "https://www.gamergear.net/content/product/605/thumb-Armaggeddon-Mikoyan-Foxbat-2084.png", 'image2' => "null", 'image3' => "null",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 3, 'cart_id' => null,
            'title' => "Alien G9X",
            'content' => "The Alien G9X by Armaggeddon uses an Optical sensor from PixArt, specifically the 3305, providing a DPI/CPI range of 400/800/1600/3200CPI, and a maximum acceleration of 20G. It uses a USB connection with a 1.8m cable.",
            'weight' => 0, 'height' => 40, 'width' => 82, 'length' => 125, 'stock' => 37, 'price' => 33,
            'imageMain' => "https://www.gamergear.net/content/product/606/thumb-Armaggeddon-Alien-G9x-2085.png", 'image1' => "https://www.gamergear.net/content/product/606/thumb-Armaggeddon-Alien-G9x-2086.png", 'image2' => "https://www.gamergear.net/content/product/606/thumb-Armaggeddon-Alien-G9x-2087.png", 'image3' => "https://www.gamergear.net/content/product/606/thumb-Armaggeddon-Alien-G9x-2088.png",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 2, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 3, 'cart_id' => null,
            'title' => "Aquila X5",
            'content' => "The Aquila X5 by Armaggeddon uses an Optical sensor, specifically the A3050, providing a DPI/CPI range of 500/1000/1500/2000CPI. This results in a tracking speed of 160ips, and a maximum acceleration of 20G. It uses a USB connection with a 1.8m cable.",
            'weight' => 0, 'height' => 43, 'width' => 68, 'length' => 130, 'stock' => 17, 'price' => 26,
            'imageMain' => "https://www.gamergear.net/content/product/607/thumb-Armaggeddon-Aquila-X5-2091.png", 'image1' => "https://www.gamergear.net/content/product/607/thumb-Armaggeddon-Aquila-X5-2092.png", 'image2' => "https://www.gamergear.net/content/product/607/thumb-Armaggeddon-Aquila-X5-2093.png", 'image3' => "https://www.gamergear.net/content/product/607/thumb-Armaggeddon-Aquila-X5-2094.png",
            'warranty' => 3, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 3, 'cart_id' => null,
            'title' => "Aquila",
            'content' => "The Aquila by Armaggeddon uses an Optical sensor, providing a DPI/CPI range of 400/800/1600/3200CPI. This results in a tracking speed of 70ips, and a maximum acceleration of 30G. It uses a USB connection with a 1.8m nylon cable.",
            'weight' => 0, 'height' => 37, 'width' => 67, 'length' => 120, 'stock' => 2, 'price' => 71,
            'imageMain' => "https://www.gamergear.net/content/product/608/thumb-Armaggeddon-Aquila-2097.png", 'image1' => "https://www.gamergear.net/content/product/608/thumb-Armaggeddon-Aquila-2097.png", 'image2' => "null", 'image3' => "null",
            'warranty' => 5, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 4, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 3, 'cart_id' => null,
            'title' => "Aliencraft G11",
            'content' => "The Aliencraft G11 by Armaggeddon uses a Laser sensor from Avago, specifically the 9500, providing a DPI/CPI range of 5040CPI . This results in a tracking speed of 150ips, and a maximum acceleration of 30g. It uses a USB connection.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 12, 'price' => 51,
            'imageMain' => "https://www.gamergear.net/content/product/641/thumb-Armaggeddon-Aliencraft-G11-2238.png", 'image1' => "https://www.gamergear.net/content/product/641/thumb-Armaggeddon-Aliencraft-G11-2239.png", 'image2' => "https://www.gamergear.net/content/product/641/thumb-Armaggeddon-Aliencraft-G11-2240.png", 'image3' => "null",
            'warranty' => 3, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 4, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 3, 'cart_id' => null,
            'title' => "Phantom",
            'content' => "The Phantom by Armaggeddon uses a Laser sensor from Avago, specifically the ADNS-9800, providing a DPI/CPI range of Default 600/1200/2000/3000/4800/6400/8200CPI. This results in a tracking speed of 150ips, and a maximum acceleration of 30g. It uses a USB connection with a 1.8m nylon cord cable.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 36, 'price' => 116,
            'imageMain' => "https://www.gamergear.net/content/product/887/thumb-Armaggeddon-Phantom-3202.png", 'image1' => "https://www.gamergear.net/content/product/887/thumb-Armaggeddon-Phantom-3203.png", 'image2' => "https://www.gamergear.net/content/product/887/thumb-Armaggeddon-Phantom-3204.png", 'image3' => "null",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 3, 'cart_id' => null,
            'title' => "Phantom",
            'content' => "The Phantom by Armaggeddon uses a Laser sensor from Avago, specifically the ADNS-9800, providing a DPI/CPI range of Default 600/1200/2000/3000/4800/6400/8200CPI. This results in a tracking speed of 150ips, and a maximum acceleration of 30g. It uses a USB connection with a 1.8m nylon cord cable.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 29, 'price' => 39,
            'imageMain' => "https://www.gamergear.net/content/product/887/thumb-Armaggeddon-Phantom-3202.png", 'image1' => "https://www.gamergear.net/content/product/887/thumb-Armaggeddon-Phantom-3203.png", 'image2' => "https://www.gamergear.net/content/product/887/thumb-Armaggeddon-Phantom-3204.png", 'image3' => "null",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 2, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 5, 'cart_id' => null,
            'title' => "Spider Queen",
            'content' => "The Spider Queen by AULA uses an Optical sensor, specifically the A3050, providing a DPI/CPI range of 800, 1200, 1600, 2000, 4000 max dpi and a maximum acceleration of 20g. It uses a USB connection with a braided cable. The Spider Queen is considered to be an ambidextrous mouse.  It weighs in at 125g grams with the cable and is approximately 127 x 80 x 42 mm (LxWxH).",
            'weight' => 125, 'height' => 42, 'width' => 80, 'length' => 127, 'stock' => 29, 'price' => 68,
            'imageMain' => "https://www.gamergear.net/content/product/609/thumb-AULA-Spider-Queen-2098.jpg", 'image1' => "https://www.gamergear.net/content/product/609/thumb-AULA-Spider-Queen-2099.jpg", 'image2' => "https://www.gamergear.net/content/product/609/thumb-AULA-Spider-Queen-2100.jpg", 'image3' => "https://www.gamergear.net/content/product/609/thumb-AULA-Spider-Queen-2101.jpg",
            'warranty' => 2, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 1, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 5, 'cart_id' => null,
            'title' => "Sacred Beetle",
            'content' => "The Sacred Beetle by AULA uses an Optical sensor. This results in a tracking speed of Max 1600DPI. It uses a USB Gold plated connection. The Sacred Beetle is considered to be an ambidextrous mouse.  It weighs in at 120+/-5g  grams with the cable and is approximately 113 x 63 x 40 mm  (LxWxH).",
            'weight' => 120, 'height' => 40, 'width' => 63, 'length' => 113, 'stock' => 1, 'price' => 87,
            'imageMain' => "https://www.gamergear.net/content/product/860/thumb-AULA-Sacred-Beetle-3100.jpg", 'image1' => "https://www.gamergear.net/content/product/860/thumb-AULA-Sacred-Beetle-3101.jpg", 'image2' => "https://www.gamergear.net/content/product/860/thumb-AULA-Sacred-Beetle-3102.jpg", 'image3' => "null",
            'warranty' => 4, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 5, 'cart_id' => null,
            'title' => "Dark Magic Scorpion",
            'content' => "The Dark Magic Scorpion by AULA uses an Optical sensor, providing a DPI/CPI range of 400-1200-2000-3200 dpi. It uses a USB Gold plated connection. The Dark Magic Scorpion is considered to be an ambidextrous mouse.  It weighs in at 107 g grams with the cable and is approximately 112 x 61 x 35 mm (LxWxH).",
            'weight' => 107, 'height' => 35, 'width' => 61, 'length' => 112, 'stock' => 29, 'price' => 93,
            'imageMain' => "https://www.gamergear.net/content/product/861/thumb-AULA-Dark-Magic-Scorpion-3103.jpg", 'image1' => "https://www.gamergear.net/content/product/861/thumb-AULA-Dark-Magic-Scorpion-3104.jpg", 'image2' => "https://www.gamergear.net/content/product/861/thumb-AULA-Dark-Magic-Scorpion-3105.jpg", 'image3' => "null",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 4, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 5, 'cart_id' => null,
            'title' => "Kill Life",
            'content' => "The Kill Life by AULA uses an Optical sensor, providing a DPI/CPI range of 400-1200-2000-3200 DPI. It uses a USB Gold-plated connection.",
            'weight' => 0, 'height' => 40, 'width' => 70, 'length' => 124, 'stock' => 23, 'price' => 26,
            'imageMain' => "https://www.gamergear.net/content/product/873/thumb-AULA-Kill-Life-3145.jpg", 'image1' => "https://www.gamergear.net/content/product/873/thumb-AULA-Kill-Life-3145.jpg", 'image2' => "https://www.gamergear.net/content/product/873/thumb-AULA-Kill-Life-3146.jpg", 'image3' => "https://www.gamergear.net/content/product/873/thumb-AULA-Kill-Life-3147.jpg",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 8, 'cart_id' => null,
            'title' => "700M",
            'content' => "The 700M by Cougar uses a Laser sensor from Avago, specifically the A9800, providing a DPI/CPI range of 8200 DPI. This is combined with a 32-bit ARM Cortex-M0. This results in a tracking speed of 150 IPS, and a maximum acceleration of 30G. It uses a USB Gold plated connection. It weighs in at 130g grams with the cable, has 4 x 4.5g weights and is approximately 127 x 83 x 38 mm (LxWxH).",
            'weight' => 130, 'height' => 38, 'width' => 83, 'length' => 127, 'stock' => 20, 'price' => 22,
            'imageMain' => "https://www.gamergear.net/content/product/715/thumb-Cougar-700m-2514.png", 'image1' => "https://www.gamergear.net/content/product/715/thumb-Cougar-700m-2515.png", 'image2' => "https://www.gamergear.net/content/product/715/thumb-Cougar-700m-2516.png", 'image3' => "https://www.gamergear.net/content/product/715/thumb-Cougar-700m-2517.png",
            'warranty' => 0, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 14, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 8, 'cart_id' => null,
            'title' => "200M",
            'content' => "The 200M by Cougar uses an Optical sensor, the A3050, providing a DPI/CPI range of 800/1600/2000 DPI. It uses a USB connection with a 1.5m Braided cable. It weighs in at 110g grams with the cable and is approximately 120 x 74 x 41mm (LxWxH).",
            'weight' => 110, 'height' => 41, 'width' => 74, 'length' => 120, 'stock' => 34, 'price' => 72,
            'imageMain' => "https://www.gamergear.net/content/product/716/thumb-Cougar-200m-2523.jpg", 'image1' => "https://www.gamergear.net/content/product/716/thumb-Cougar-200m-2523.jpg", 'image2' => "null", 'image3' => "null",
            'warranty' => 2, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 13, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 8, 'cart_id' => null,
            'title' => "600M",
            'content' => "The 600M by Cougar uses a Laser sensor from Avago, specifically the A9800, providing a DPI/CPI range of 8200 DPI. This is combined with a 32-bit ARM Cortex-M0. This results in a tracking speed of 150 IPS, and a maximum acceleration of 30G. It uses a USB gold plated connection with a 1.8m braided cable. It weighs in at 90g grams with the cable and is approximately 125 x 80 x 42 mm (LxWxH).",
            'weight' => 90, 'height' => 42, 'width' => 80, 'length' => 125, 'stock' => 37, 'price' => 143,
            'imageMain' => "https://www.gamergear.net/content/product/837/thumb-Cougar-600m-3017.png", 'image1' => "https://www.gamergear.net/content/product/837/thumb-Cougar-600m-3018.png", 'image2' => "https://www.gamergear.net/content/product/837/thumb-Cougar-600m-3019.png", 'image3' => "https://www.gamergear.net/content/product/837/thumb-Cougar-600m-3020.png",
            'warranty' => 0, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 8, 'cart_id' => null,
            'title' => "Minos X2",
            'content' => "The Minos X2 by Cougar uses an Optical sensor, specifically the ADNS-3050, providing a DPI/CPI range of 500/1000/1500/2000/3000 DPI.. It uses a USB connection with a 1.8m cable. It weighs in at 94g grams with the cable, has Mo weights and is approximately 122 x 67 x 4 mm (LxWxH).",
            'weight' => 94, 'height' => 40, 'width' => 67, 'length' => 122, 'stock' => 4, 'price' => 72,
            'imageMain' => "https://www.gamergear.net/content/product/1277/thumb_minos-x2-04.png", 'image1' => "https://www.gamergear.net/content/product/1277/thumb_minos-x2-02.png", 'image2' => "https://www.gamergear.net/content/product/1277/thumb_minos-x2-03.png", 'image3' => "https://www.gamergear.net/content/product/1277/thumb_minos-x2-04.png",
            'warranty' => 5, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 7, 'article_type_id' => 6, 'article_purpose_id' => 1,'brand_id' => 8, 'cart_id' => null,
            'title' => "Surpassion ST",
            'content' => "The Surpassion ST by Cougar uses an Optical sensor from Pixart, specifically the PMW3325, providing a DPI/CPI range of 800 / 400 / 1600 / 3200 DPI. This is combined with a 32 bit Arm Processor. This results in a tracking speed of 100 IPS, and a maximum acceleration of 20 G. It uses a USB connection with a 1.8m cable. It weighs in at 96g without the cable and is approximately 120 x 65 x 38 mm (LxWxH).",
            'weight' => 0, 'height' => 38, 'width' => 65, 'length' => 120, 'stock' => 23, 'price' => 139,
            'imageMain' => "https://www.gamergear.net/content/product/1548/thumb-Surpassion-ST-05.png", 'image1' => "https://www.gamergear.net/content/product/1548/thumb-Surpassion-ST-02.png", 'image2' => "https://www.gamergear.net/content/product/1548/thumb-Surpassion-ST-03.png", 'image3' => "https://www.gamergear.net/content/product/1548/thumb-Surpassion-ST-04.png",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 9, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 11, 'cart_id' => null,
            'title' => "MeduZa",
            'content' => "The MeduZa by Epic Gear uses an Optical sensor, specifically the A3060, providing a DPI/CPI range of Optical: 400/800/1600/3200 dpi Laser: up to 6030dpi. This is combined with a ARM 32-bit Cortex M3 Processor. This results in a tracking speed of 200 ips, and a maximum acceleration of 30 G. It uses a USB connection with a 2m braided cable.",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 29, 'price' => 147,
            'imageMain' => "https://www.gamergear.net/content/product/717/thumb-Epic-Gear-Meduza-2524.jpg", 'image1' => "https://www.gamergear.net/content/product/717/thumb-Epic-Gear-Meduza-2525.jpg", 'image2' => "https://www.gamergear.net/content/product/717/thumb-Epic-Gear-Meduza-2526.jpg", 'image3' => "https://www.gamergear.net/content/product/717/thumb-Epic-Gear-Meduza-2527.png",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 3, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 11, 'cart_id' => null,
            'title' => "Blade",
            'content' => "The Blade by Epic Gear uses an Optical sensor, specifically the A3050, providing a DPI/CPI range of 2000dpi. It uses a USB connection with a 1.8m Braided cable. It weighs in at 93g without the cable",
            'weight' => 0, 'height' => null, 'width' => null, 'length' => null, 'stock' => 0, 'price' => 26,
            'imageMain' => "https://www.gamergear.net/content/product/718/thumb-Epic-Gear-Blade-2528.png", 'image1' => "https://www.gamergear.net/content/product/718/thumb-Epic-Gear-Blade-2529.png", 'image2' => "https://www.gamergear.net/content/product/718/thumb-Epic-Gear-Blade-2530.png", 'image3' => "null",
            'warranty' => 1, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 8, 'article_type_id' => 6, 'article_purpose_id' => 3,'brand_id' => 11, 'cart_id' => null,
            'title' => "ZorA",
            'content' => "The ZorA by Epic Gear uses an Optical sensor, providing a DPI/CPI range of 3500dpi. This results in a tracking speed of 60ips, and a maximum acceleration of 20G. It uses a USB Gold Plated connection with a 1.8m braided cable. It weighs in at 110 g without the cable, has 4 x 5g weights and is approximately 126.5 x 66.5 x 40 mm (LxWxH).",
            'weight' => 0, 'height' => 40, 'width' => 66, 'length' => 126, 'stock' => 20, 'price' => 112,
            'imageMain' => "https://www.gamergear.net/content/product/1008/thumb_ZorA-001.png", 'image1' => "https://www.gamergear.net/content/product/1008/thumb_ZorA-002.jpg", 'image2' => "https://www.gamergear.net/content/product/1008/thumb_ZorA-003.jpg", 'image3' => "https://www.gamergear.net/content/product/1008/thumb_ZorA-004.jpg",
            'warranty' => 4, 'created_at' => null, 'updated_at' => null
        ],
        ['category_id' => 2, 'compatibility_id' => 15, 'article_type_id' => 6, 'article_purpose_id' => 2,'brand_id' => 11, 'cart_id' => null,
            'title' => "Cyclops X",
            'content' => "The Cyclops X by Epic Gear uses an Optical sensor from Avago, specifically the ADNS-3310 / PMW3310, providing a DPI/CPI range of 5000dpi . This results in a tracking speed of 130 ips, and a maximum acceleration of 30G. It uses a USB, gold plated connection with a 1.8m braided cable. It weighs in at 110g without the cable and is approximately 123 x 70 x 42 mm (LxWxH).",
            'weight' => 0, 'height' => 42, 'width' => 70, 'length' => 123, 'stock' => 15, 'price' => 139,
            'imageMain' => "https://www.gamergear.net/content/product/866/thumb-Epic-Gear-Cyclops-X-3119.jpg", 'image1' => "https://www.gamergear.net/content/product/866/thumb-Epic-Gear-Cyclops-X-3117.jpg", 'image2' => "https://www.gamergear.net/content/product/866/thumb-Epic-Gear-Cyclops-X-3118.png", 'image3' => "https://www.gamergear.net/content/product/866/thumb-Epic-Gear-Cyclops-X-3119.jpg",
            'warranty' => 3, 'created_at' => null, 'updated_at' => null
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $category = $manager->getRepository(Category::class);
        $compatibility = $manager->getRepository(Compatibility::class);
        $articleType = $manager->getRepository(ArticleType::class);
        $articlePurpose = $manager->getRepository(ArticlePurpose::class);
        $brand = $manager->getRepository(Brand::class);

        foreach ($this->articles as $item) {

            $article = new Article();

            $article->setCategory($category->find($item['category_id']));
            $article->setCompatibility($compatibility->find($item['compatibility_id']));
            $article->setArticleType($articleType->find($item['article_type_id']));
            $article->setArticlePurpose($articlePurpose->find($item['article_purpose_id']));
            $article->setBrand($brand->find($item['brand_id']));


            $article->setTitle($item['title']);
            $article->setContent($item['content']);
            if ($item['weight']) {
                $article->setWeight($item['weight']);
            }
            if ($item['height']) {
                $article->setHeight($item['height']);
            }
            if ($item['length']) {
                $article->setLength($item['length']);
            }
            if ($item['width']) {
                $article->setWidth($item['width']);
            }
            $article->setStock($item['stock']);
            $article->setPrice($item['price']);

            if ($item['imageMain']) {
                $article->setImageMain($item['imageMain']);
            }
            if ($item['image1']) {
                $article->setImage1($item['image1']);
            }
            if ($item['image2']) {
                $article->setImage2($item['image2']);
            }
            if ($item['image3']) {
                $article->setImage3($item['image3']);
            }

            $article->setCreatedAt(new \DateTime());

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return array(
            CategoryFixtures::class,
        );
    }
}
