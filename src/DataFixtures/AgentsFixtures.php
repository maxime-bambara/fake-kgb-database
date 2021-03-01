<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Agents;
use App\Entity\Skills;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AgentsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $defaultSkill = new Skills;
        $defaultSkill->setName('kill');

        for ($i = 0; $i <= 15; $i++) {
            $agent = new Agents();
            $faker = Factory::create();
            $agent->setLastName($faker->lastName);
            $agent->setFirstName($faker->lastName);
            $agent->setBirthday($faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null));
            $agent->setCode($faker->unique->colorName);
            $agent->setNationality($faker->country);
            $agent->addSkill($defaultSkill);
            $manager->persist($agent);
        }
        $manager->flush();
    }
}
