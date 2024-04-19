<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        // $user = new User();
        // $user->setEmail("testUser@test.fr")->setPassword($hasher->hashPassword($user,'password12'))->setRoles([]);
        // $manager->flush();
        // $user = new User();
        // $user->setEmail("testAdmin@test.fr")->setPassword($hasher->hashPassword($user,'amimin1#'))->setRoles(['ADMINISATOR']);
        // $em->persist($user);
        // $em->flush();
        // console: > php bin/console doctrine:fixtures:load

    }
}
