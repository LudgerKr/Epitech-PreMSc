<?php

namespace App\DataFixtures;

use App\Entity\ArticleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleTypeFixtures extends Fixture
{
    public $articleTypes = [
        ['name' => "Processeur"], ['name' => "Carte mère"], ['name' => "RAM"],
        ['name' => "USB"], ['name' => "Clavier"], ['name' => "Souris"],
        ['name' => "Ventilateur"], ['name' => "Watercooling"], ['name' => "Pâte thermique"],
        ['name' => "Carte Graphique"], ['name' => "SSD"], ['name' => "HDD"],
        ['name' => "M.2"], ['name' => "Graveur / DVD"], ['name' => "Lecteur Cartes"],
        ['name' => "Carte Wifi"], ['name' => "Carte Son"], ['name' => "Boîtier"],
        ['name' => "Alimentation"], ['name' => "Carte réseau"], ['name' => "Ecran"],
        ['name' => "Caméra"], ['name' => "LED"], ['name' => "Multiport USB"],
        ['name' => "Casque"], ['name' => "Enceintes"], ['name' => "Stream Deck/Boîtier d'acquisition"],
        ['name' => "Manette"], ['name' => "Alimentation"], ['name' => "Batterie"]
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->articleTypes as $item) {
            $articleType = new ArticleType();
            $articleType->setName($item['name']);

            $manager->persist($articleType);
        }

        $manager->flush();
    }
}
