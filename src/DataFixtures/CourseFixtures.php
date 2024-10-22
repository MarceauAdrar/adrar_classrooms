<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CourseFixtures extends Fixture 
{
    public const COURSE_REFERENCE_TAG = 'course-';
    public const COURSE_COUNT = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < self::COURSE_COUNT; $i++) { 
            $course = new Course();
            $course->setTitle($faker->sentence(6));
            $course->setSynopsis($faker->text(200));
            $course->setLevel($faker->numberBetween(1, 3));
            $course->setEstimatedTime($faker->numberBetween(1, 100));
            $course->setPicture($faker->imageUrl(640, 480, 'course'));
            $course->setDate(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 year', 'now')));

            $manager->persist($course);
            $this->addReference(self::COURSE_REFERENCE_TAG . $i, $course);
        }
        $manager->flush();
    }
}
