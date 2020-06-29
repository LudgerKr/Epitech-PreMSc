<?php

namespace App\DataFixtures;

use App\Entity\Compatibility;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CompatibilityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $compatibility = new Compatibility();
            $compatibility->setName("Compatibilité " . $i);
            $manager->persist($compatibility);
        }

        $manager->flush();
    }
}
