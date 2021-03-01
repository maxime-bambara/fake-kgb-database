<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Targets;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TargetsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 15; $i++) {
            $target = new Targets();
            $faker = Factory::create();
            $target->setLastName($faker->lastName);
            $target->setFirstName($faker->lastName);
            $target->setBirthday($faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null));
            $target->setAlias($faker->unique->jobTitle);
            $target->setNationality($faker->country);
            $manager->persist($target);
        }
        $manager->flush();
    }
}
