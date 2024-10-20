<?php

namespace App\DataFixtures;

use App\Entity\Concessionnaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ConcessionnaireFixtures extends Fixture
{
    public const CONCESSIONNAIRE_REFERENCE_TAG = 'concessionnaire-';
    public const CONCESSIONNAIRE_COUNT = 50;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < self::CONCESSIONNAIRE_COUNT; $i++) { 
            $concessionnaire = new Concessionnaire();
            $concessionnaire->setNom($faker->word);
            $concessionnaire->setGroupe($faker->company);
            $concessionnaire->setAdresseNumero($faker->buildingNumber);
            $concessionnaire->setAdresseRue($faker->streetName);
            $concessionnaire->setAdresseVille($faker->city);
            $concessionnaire->setAdresseCp($faker->postcode);

            $manager->persist($concessionnaire);
            $this->addReference(self::CONCESSIONNAIRE_REFERENCE_TAG . $i, $concessionnaire);
        }
        $manager->flush();
    }
}
