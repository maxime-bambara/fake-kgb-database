<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Hideaway;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HideawayFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $hideawayTypes = [
            'Hôtel',
            'Appartment',
            'Villa',
            'Bunker',
            'Boat'
        ];

        for ($i = 0; $i <= 15; $i++) {
            $hideaway = new Hideaway();
            $faker = Factory::create();
            $hideaway->setAdress($faker->unique->address);
            $hideaway->setAlias($faker->unique->company);
            $hideaway->setType($faker->randomElement($hideawayTypes));
            $hideaway->setCountry($faker->country);
            $manager->persist($hideaway);
        }
        $manager->flush();
    }
}
