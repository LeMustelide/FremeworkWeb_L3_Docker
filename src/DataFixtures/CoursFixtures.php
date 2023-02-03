<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Entity\Semestre;
use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $user = $manager->getRepository(User::class)->find(1);
        for($nbSemestre=1; $nbSemestre<=4; $nbSemestre++){
            $semestre = new Semestre();
            $semestre->setFormation($faker->sentence(3, true));
            $semestre->setSemestre($nbSemestre);
            $manager->persist($semestre);
            for($nbCours=1; $nbCours<=5; $nbCours++){
                $cours = new Cours();
                $cours->setEnseignant($user);
                $cours->setNom($faker->sentence(3, true))
                    -> setDescription($faker->text(200))
                    -> setSemestre($semestre)
                    -> setCreationDate($faker->dateTimeBetween('-1 years', 'now'));
                $manager->persist($cours);
            }
        }

        $manager->flush();
    }
}
