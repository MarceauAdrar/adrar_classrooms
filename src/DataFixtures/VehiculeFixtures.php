<?php

namespace App\DataFixtures;

use App\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VehiculeFixtures extends Fixture
{
    public const VEHICULE_REFERENCE_TAG = 'vehicule-';
    public const VEHICULE_COUNT = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < self::VEHICULE_COUNT; $i++) { 
            $vehicule = new Vehicule();
            $vehicule->setNom($faker->word);
            $vehicule->setCouleur(str_replace('#', '', strtoupper($faker->hexColor)));
            $vehicule->setMarque($faker->company);

            $manager->persist($vehicule);
            $this->addReference(self::VEHICULE_REFERENCE_TAG . $i, $vehicule);
        }
        $manager->flush();
    }
}
