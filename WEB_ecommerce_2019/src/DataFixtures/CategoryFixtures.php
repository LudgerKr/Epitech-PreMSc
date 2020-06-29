<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public $catogories = [
        ['name' => "Stockage", "description" => "Différent Stockage"],
        ['name' => "Périphérique", "description" => "Différent Périphérique"],
        ['name' => "Cartes", "description" => "Différente Cartes"],
        ['name' => "Refroidissement", "description" => "Différent Refroidissement"],
        ['name' => "Disque Dur", "description" => "Différent Disque Dur"],
        ['name' => "Alimentation", "description" => "Différente Alimentation"]
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->catogories as $item) {
            $category = new Category();

            $category->setName($item["name"]);
            $category->setDescription($item["description"]);

            $manager->persist($category);
        }
        $manager->flush();
    }
}
