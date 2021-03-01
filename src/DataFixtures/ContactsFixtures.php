<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contacts;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= 15; $i++) {
            $contact = new Contacts();
            $faker = Factory::create();
            $contact->setLastName($faker->lastName);
            $contact->setFirstName($faker->lastName);
            $contact->setBirthday($faker->dateTimeBetween($startDate = '-50 years', $endDate = 'now', $timezone = null));
            $contact->setCode($faker->unique->colorName);
            $contact->setNationality($faker->country);
            $manager->persist($contact);
        }
        $manager->flush();
    }
}
