<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    /* Find on https://www.gamergear.net/product.php */
    public $brands = [
        ['name' => "1st Player",  'picture' => "https://www.gamergear.net/content/brand/1stplayer.jpg"],
        ['name' => "Anker",  'picture' => "https://www.gamergear.net/content/brand/logo_anker.png"],
        ['name' => "Armaggeddon",  'picture' => "https://www.gamergear.net/content/brand/logo_armaggeddon.png"],
        ['name' => "ASUS",  'picture' => "https://www.gamergear.net/content/brand/logo_asus.png"],
        ['name' => "AULA",  'picture' => "https://www.gamergear.net/content/brand/logo_aula.png"],
        ['name' => "Azio",  'picture' => "https://www.gamergear.net/content/brand/logo_azio.jpg"],
        ['name' => "CoolerMaster",  'picture' => "https://www.gamergear.net/content/brand/logo_cmstorm.jpg"],
        ['name' => "Cougar",  'picture' => "https://www.gamergear.net/content/brand/logo_cougar.png"],
        ['name' => "Das Keyboard",  'picture' => "https://www.gamergear.net/content/brand/daskeyboard-logo-309.png"],
        ['name' => "Digital Alliance",  'picture' => "https://www.gamergear.net/content/brand/DigitalAlliance.png"],
        ['name' => "Epic Gear",  'picture' => "https://www.gamergear.net/content/brand/logo_epicgear.png"],
        ['name' => "Filco",  'picture' => "https://www.gamergear.net/content/brand/filco.png"],
        ['name' => "Fnatic",  'picture' => "https://www.gamergear.net/content/brand/fnatic_logo.png"],
        ['name' => "Genius",  'picture' => "https://www.gamergear.net/content/brand/logo_genius.png"],
        ['name' => "Glorious",  'picture' => "https://www.gamergear.net/content/brand/glorious-logo.png"],
        ['name' => "Hyper X",  'picture' => "https://www.gamergear.net/content/brand/logo-hyperx.png"],
        ['name' => "Leopold",  'picture' => "https://www.gamergear.net/content/brand/logo_leopold.png"],
        ['name' => "MadCatz",  'picture' => "https://www.gamergear.net/content/brand/logo_madcatz.png"],
        ['name' => "Microsoft",  'picture' => "https://www.gamergear.net/content/brand/Microsoft.jpg"],
        ['name' => "MSI",  'picture' => "https://www.gamergear.net/content/brand/logo_MSI.png"],
        ['name' => "Ozone",  'picture' => "https://www.gamergear.net/content/brand/logo_ozone.png"],
        ['name' => "Plantronics",  'picture' => "https://www.gamergear.net/content/brand/logo_plantronics.png"],
        ['name' => "QPAD",  'picture' => "https://www.gamergear.net/content/brand/logo_qpad.png"],
        ['name' => "Rapoo",  'picture' => "https://www.gamergear.net/content/brand/logo_rapoo.png"],
        ['name' => "Rexus",  'picture' => "https://www.gamergear.net/content/brand/rexus.png"],
        ['name' => "Rogue",  'picture' => "https://www.gamergear.net/content/brand/logo_rogue.png"],
        ['name' => "Sennheiser",  'picture' => "https://www.gamergear.net/content/brand/logo_sennheiser.png"],
        ['name' => "Steelseries",  'picture' => "https://www.gamergear.net/content/brand/SteelSeries_logo.jpg"],
        ['name' => "ThermalTake",  'picture' => "https://www.gamergear.net/content/brand/logo_tte.png"],
        ['name' => "Tritton",  'picture' => "https://www.gamergear.net/content/brand/logo_tritton.jpg"],
        ['name' => "UtechSmart",  'picture' => "https://www.gamergear.net/content/brand/logo_utechsmart.png"],
        ['name' => "XTracPads",  'picture' => "https://www.gamergear.net/content/brand/logo_xtracpads.png"],
        ['name' => "Zalman",  'picture' => "https://www.gamergear.net/content/brand/logo_zalman.png"],
        ['name' => "A4 TECH",  'picture' => "https://www.gamergear.net/content/brand/logo_a4tech.png"],
        ['name' => "Aorus",  'picture' => "https://www.gamergear.net/content/brand/aorus_logo.png"],
        ['name' => "Astro",  'picture' => "https://www.gamergear.net/content/brand/Astro-Gaming.png"],
        ['name' => "Audio-Technica",  'picture' => "https://www.gamergear.net/content/brand/logo_audiotechnica.png"],
        ['name' => "AVerMedia",  'picture' => "https://www.gamergear.net/content/brand/AverMedia.png"],
        ['name' => "Bloody",  'picture' => "https://www.gamergear.net/content/brand/logo_bloody.png"],
        ['name' => "Corsair",  'picture' => "https://www.gamergear.net/content/brand/logo_corsair.png"],
        ['name' => "Creative Labs",  'picture' => "https://www.gamergear.net/content/brand/Creative-Labs.png"],
        ['name' => "Deck",  'picture' => "https://www.gamergear.net/content/brand/deck_logo.png"],
        ['name' => "Ducky",  'picture' => "https://www.gamergear.net/content/brand/logo_ducky.jpg"],
        ['name' => "EVGA",  'picture' => "https://www.gamergear.net/content/brand/logo_evga.png"],
        ['name' => "FinalMouse",  'picture' => "https://www.gamergear.net/content/brand/finalmouse-logo.png"],
        ['name' => "FUNC",  'picture' => "https://www.gamergear.net/content/brand/logo_FUNC.png"],
        //['name' => "G.Skill",  'picture' => "https://www.gamergear.net/content/brand/G.Skill-logo.png"],
        ['name' => "Gamdias",  'picture' => "https://www.gamergear.net/content/brand/logo_gamdias.png"],
        ['name' => "Gigabyte",  'picture' => "https://www.gamergear.net/content/brand/logo_gigabyte.png"],
        ['name' => "HexGears",  'picture' => "https://www.gamergear.net/content/brand/hexgears.png"],
        ['name' => "Leetgion",  'picture' => "https://www.gamergear.net/content/brand/logo_leetgion.png"],
        ['name' => "Logitech",  'picture' => "https://www.gamergear.net/content/brand/logo_logitech.png"],
        ['name' => "MAX",  'picture' => "https://www.gamergear.net/content/brand/logo_max.png"],
        ['name' => "Mionix",  'picture' => "https://www.gamergear.net/content/brand/logo_mionix.png"],
        ['name' => "Noppoo",  'picture' => "https://www.gamergear.net/content/brand/logo_noppoo.png"],
        ['name' => "Patriot",  'picture' => "https://www.gamergear.net/content/brand/patriot.png"],
        ['name' => "Psyko Audio",  'picture' => "https://www.gamergear.net/content/brand/logo_psyko.png"],
        ['name' => "Rantopad",  'picture' => "https://www.gamergear.net/content/brand/rantopad.png"],
        ['name' => "Razer",  'picture' => "https://www.gamergear.net/content/brand/logo_razer.png"],
        ['name' => "Roccat",  'picture' => "https://www.gamergear.net/content/brand/logo_roccat.jpg"],
        ['name' => "Sades",  'picture' => "https://www.gamergear.net/content/brand/sades.png"],
        ['name' => "Sharkoon",  'picture' => "https://www.gamergear.net/content/brand/logo_sharkoon.png"],
        ['name' => "Tesoro",  'picture' => "https://www.gamergear.net/content/brand/tesoro_logo.png"],
        ['name' => "ThunderX3",  'picture' => "https://www.gamergear.net/content/brand/thunderx3_logo.png"],
        ['name' => "Turtle Beach",  'picture' => "https://www.gamergear.net/content/brand/logo_turtlebeach.png"],
        ['name' => "Vortex",  'picture' => "https://www.gamergear.net/content/brand/logo_vortex.png"],
        ['name' => "Xtrfy",  'picture' => "https://www.gamergear.net/content/brand/Xtrfy-logo.png"],
        ['name' => "Zowie Gear",  'picture' => "https://www.gamergear.net/content/brand/logo_zowie.png"]
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->brands as $item) {
            $brand = new Brand();
            $brand->setName($item['name']);
            $brand->setPicture($item['picture']);

            $manager->persist($brand);
        }

        $manager->flush();
    }
}
