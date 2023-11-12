<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;
use DateTimeImmutable;

class UserFixtures extends Fixture 
{

    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');



        for($nbUtilisateur = 1; $nbUtilisateur <= 30; $nbUtilisateur++){
            $user = new User();
            $user->setEmail($faker->email);
            if($nbUtilisateur === 1)
                $user->setRoles(['ROLE_ADMIN']);
            else
                $user->setRoles(['ROLE_USER']);
            
            $plainPassword = 'azerty'; // Set your default password or generate one as needed
            $hashedPassword = $this->hasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);
            $manager->persist($user);
            $this->addReference('user_'. $nbUtilisateur, $user);
        }

        $manager->flush();
    }
}