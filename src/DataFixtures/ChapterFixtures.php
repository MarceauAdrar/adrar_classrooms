<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ChapterFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHAPTER_REFERENCE_TAG = 'chapter-';
    public const CHAPTER_COUNT = 500;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < self::CHAPTER_COUNT; $i++) { 
            $chapter = new Chapter();
            $chapter->setTitle($faker->sentence(6));
            $chapter->setContent($faker->text(200));
            $chapter->setPosition($faker->numberBetween(1, 10));
            $chapter->setCourse($this->getReference(CourseFixtures::COURSE_REFERENCE_TAG . rand(0, CourseFixtures::COURSE_COUNT - 1)));

            $manager->persist($chapter);
            $this->addReference(self::CHAPTER_REFERENCE_TAG . $i, $chapter);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CourseFixtures::class
        ];
    }
}
