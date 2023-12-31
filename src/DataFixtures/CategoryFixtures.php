<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $categoryNames = ['citroen', 'mercedes', 'peugeot', 'ferrari', 'renault'];

        // Création de 5 catégories
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($categoryNames[$i]); // Corrected variable name
            
            $manager->persist($category);
        
            $this->addReference("category_$i", $category);
        }

        $manager->flush();
    }
}
