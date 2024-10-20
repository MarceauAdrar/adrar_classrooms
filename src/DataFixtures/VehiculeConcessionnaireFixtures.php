<?php

namespace App\DataFixtures;

use App\Entity\VehiculeConcessionnaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VehiculeConcessionnaireFixtures extends Fixture implements DependentFixtureInterface
{
    public const VEHICULE_CONCESSIONNAIRE_REFERENCE_TAG = 'vehicule-concessionnaire-';
    public const VEHICULE_CONCESSIONNAIRE_COUNT = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < self::VEHICULE_CONCESSIONNAIRE_COUNT; $i++) { 
            $vehiculeConcessionnaire = new VehiculeConcessionnaire();
            $vehiculeConcessionnaire->setVehicule($this->getReference(VehiculeFixtures::VEHICULE_REFERENCE_TAG . rand(0, VehiculeFixtures::VEHICULE_COUNT - 1)));
            $vehiculeConcessionnaire->setConcessionnaire($this->getReference(ConcessionnaireFixtures::CONCESSIONNAIRE_REFERENCE_TAG . rand(0, ConcessionnaireFixtures::CONCESSIONNAIRE_COUNT - 1)));

            $manager->persist($vehiculeConcessionnaire);
            $this->addReference(self::VEHICULE_CONCESSIONNAIRE_REFERENCE_TAG . $i, $vehiculeConcessionnaire);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VehiculeFixtures::class,
            ConcessionnaireFixtures::class,
        ];
    }
}
