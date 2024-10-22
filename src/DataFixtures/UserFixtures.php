<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE_TAG = 'user-';
    public const USER_COUNT = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        // Create the admin user
        $user = new User();
        $user->setUsername("admin");
        $user->setPassword(password_hash('adminnum', PASSWORD_BCRYPT));
        $user->setLastName("Les");
        $user->setFirstName("Admin");
        $user->setImage($faker->imageUrl(640, 480, 'network'));
        $manager->persist($user);

        // Create the dev user
        $user = new User();
        $user->setUsername("dev");
        $user->setPassword(password_hash('devnum', PASSWORD_BCRYPT));
        $user->setLastName($faker->lastName);
        $user->setFirstName($faker->firstName);
        $user->setImage("default_avatar.png");
        $manager->persist($user);

        for ($i = 0; $i < self::USER_COUNT; $i++) { 
            $user = new User();
            $user->setUsername($faker->unique()->userName);
            $user->setPassword(password_hash('pwd' . $user->getUsername(), PASSWORD_BCRYPT));
            $user->setLastName($faker->lastName);
            $user->setFirstName($faker->firstName);
            $user->setImage($faker->imageUrl(640, 480, 'people'));
            if (rand(1, 10) <= 7) {
                $user->setGoogleId($faker->unique()->uuid);
            }

            $manager->persist($user);
            $this->addReference(self::USER_REFERENCE_TAG . $i, $user);
        }
        $manager->flush();
    }
}
