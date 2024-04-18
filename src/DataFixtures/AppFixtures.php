<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        // $user = new User();
        // $user->setEmail("testUser@test.fr")->setPassword($hasher->hashPassword($user,'password12'))->setRoles([]);
        // $em->persist($user);
        // $manager->flush();
        // console: >php bin/console doctrine:fixtures:load

    }
}
