<?php

namespace App\DataFixtures;

use App\Entity\ArticlePurpose;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticlePurposeFixtures extends Fixture
{
    public $articlePurposes = [
        ['name' => "bureautique"],
        ['name' => "gaming"],
        ['name' => "pro"],
    ];
    
    public function load(ObjectManager $manager)
    {
        foreach ($this->articlePurposes as $item) {
            $articlePurpose = new ArticlePurpose();
            $articlePurpose->setName($item['name']);

            $manager->persist($articlePurpose);
        }

        $manager->flush();
    }
}
