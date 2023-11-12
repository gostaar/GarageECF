<?php

namespace App\DataFixtures;

use App\Entity\voiture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Images;
use Faker;

class VoitureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $faker = Faker\Factory::create('fr_FR');

        for($nbvoiture = 1; $nbvoiture <= 30; $nbvoiture++){
            $voiture = new Voiture();
            $voiture->setName($faker->name);
            $voiture->setDescription($faker->text);
            $voiture->setContent($faker->text);
            $voiture->setPrice($faker->numberBetween(1000, 10000));
            $voiture->setModele($faker->text);
            $voiture->setEstVendu($faker->boolean(10));
            $voiture->addCategory($this->getReference("category_" . $faker->numberBetween(1, 5)));

            $imagesNames = ['image.png', 'car.png', 'image.jpg'];
            foreach ($imagesNames as $imageName) {
                $imageAnnonce = new Images();
                $imageAnnonce->setName($imageName);
                $voiture->addImage($imageAnnonce);
            }



            $manager->persist($voiture);

        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
