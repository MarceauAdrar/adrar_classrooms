<?php

namespace App\DataFixtures;

use App\Entity\Opinion;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OpinionFixtures extends Fixture implements DependentFixtureInterface
{
    public const OPINION_REFERENCE_TAG = 'opinion-';
    public const OPINION_COUNT = UserFixtures::USER_COUNT / 3;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        $users = [];
        for ($i = 0; $i < self::OPINION_COUNT; $i++) { 
            $user = $this->getReference(UserFixtures::USER_REFERENCE_TAG . rand(0, UserFixtures::USER_COUNT - 1));
            if(!in_array($user, $users)) {
                $users[] = $user;
                $opinion = new Opinion();
                $opinion->setComment($faker->text(200));
                $opinion->setUser($user);
                $manager->persist($opinion);
                $this->addReference(self::OPINION_REFERENCE_TAG . $i, $opinion);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
