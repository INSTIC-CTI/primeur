<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $a1 = new Aliment();
      $a1->setNom('Carotte')
          ->setPrix(1.80)
          ->setCalorie(36)
          ->setProteine(0.77)
          ->setGlucide(6.45)
          ->setLipide(0.26)
          ->setImage('carotte.jpg');

      $a2 = new Aliment();
      $a2->setNom('Tomate')
          ->setPrix(1.20)
          ->setCalorie(42)
          ->setProteine(0.65)
          ->setGlucide(5.30)
          ->setLipide(0.45)
          ->setImage('tomate.jpg');

      $a3 = new Aliment();
      $a3->setNom('Patate')
          ->setPrix(0.90)
          ->setCalorie(30)
          ->setProteine(0.52)
          ->setGlucide(7.06)
          ->setLipide(0.14)
          ->setImage('patate.jpg');

      $a4 = new Aliment();
      $a4->setNom('Pomme')
          ->setPrix(1.40)
          ->setCalorie(50)
          ->setProteine(0.80)
          ->setGlucide(5.40)
          ->setLipide(0.17)
          ->setImage('pomme.jpg');

      $manager->persist($a1);
      $manager->persist($a2);
      $manager->persist($a3);
      $manager->persist($a4);

      $manager->flush();

    }
}
