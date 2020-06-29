<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encode;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encode = $encoder;
    }

    public $users = [
        ['email' => "admin@admin.com",
            'username' => "admin",
            'password' => "admin",
            'birthdate' => "10/10/1010",
            'roles' => "ROLE_ADMIN",
        ],
        ['email' => "user@user.com",
            'username' => "user",
            'password' => "user",
            'birthdate' => "10/10/1010",
            'roles' => "ROLE_USER",
        ],
        ['email' => "toto@toto.com",
            'username' => "toto",
            'password' => "toto",
            'birthdate' => "10/10/10",
            'roles' => "ROLE_USER",
        ],
        ['email' => "richard.rdla@gmail.com",
            'username' => "Ludger",
            'password' => "richard",
            'birthdate' => "10/10/1010",
            'roles' => "ROLE_ADMIN",
        ],
        ['email' => "quentin.sommer1@gmail.com",
            'username' => "Acaroux",
            'password' => "quentin",
            'birthdate' => "10/10/1000",
            'roles' => "ROLE_ADMIN",
        ],

    ];
    public function load(ObjectManager $manager)
    {
        foreach ($this->users as $item) {
            $user = new User();
            $user->setEmail($item['email']);
            $user->setUsername($item['username']);
            $user->setRoles(array($item['roles']));

            $encoded = $this->encode->encodePassword($user, $item['password']);
            $user->setPassword($encoded);
            $date = new \DateTime($item['birthdate']);
            $user->setBirthdate($date);
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
        }

        $manager->flush();
    }
}
