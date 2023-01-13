<?php

namespace App\DataFixtures;

use App\Entity\Cours;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10; $i++){
            $cours = new Cours();
            $cours->setNom("Nom n°$i")
                -> setDescription("Description n°$i")
                ->setSemestre(6);
            $manager->persist($cours);
        }

        $manager->flush();
    }
}
