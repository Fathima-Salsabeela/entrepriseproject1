<?php

namespace App\DataFixtures;

use App\Entity\Employer;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployerFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   for($i =1; $i <= 10; $i++){
        $employer = new Employer;

            $employer->setPrenom("Salsabeela")
                    ->setNom("Samoon")
                    ->setTelephone("0768290411")
                    ->setEmail("beelafr@gmail.com")
                    ->setAddress("10 rue charlie chaplin sevran 93270")
                    ->setPoste("Developpeur")
                    ->setSalaire("1250")
                    ->setDateDenaissance(new \DateTime );
            $manager->persist($employer);
    }
       

        $manager->flush();
    }
}
