<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Model;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $b1 = new Brand();
        $b1->setLabel('citro');
        $manager->persist($b1);

        $b2 = new Brand();
        $b2->setLabel('reyno');
        $manager->persist($b2);

        $b3 = new Brand();
        $b3->setLabel('dillac');
        $manager->persist($b3);

        $m1 = new Model();
        $m1->setLabel('c1')
            ->setImage('modele1.jpg')
            ->setAveragePrice(12000)
            ->setBrand($b1);
        $manager->persist($m1);

        $m2 = new Model();
        $m2->setLabel('g12')
            ->setImage('modele2.jpg')
            ->setAveragePrice(13000)
            ->setBrand($b2);
        $manager->persist($m2);

        $m3 = new Model();
        $m3->setLabel('montecarlo')
            ->setImage('modele3.jpg')
            ->setAveragePrice(22000)
            ->setBrand($b3);
        $manager->persist($m3);

        $m4 = new Model();
        $m4->setLabel('c6')
            ->setImage('modele4.jpg')
            ->setAveragePrice(11000)
            ->setBrand($b1);
        $manager->persist($m4);

        $m5 = new Model();
        $m5->setLabel('buffalo')
            ->setImage('modele5.jpg')
            ->setAveragePrice(23000)
            ->setBrand($b3);
        $manager->persist($m5);

        $m6 = new Model();
        $m6->setLabel('g5')
            ->setImage('modele5.jpg')
            ->setAveragePrice(11000)
            ->setBrand($b2);
        $manager->persist($m6);

        $modeles = [$m1, $m2, $m3, $m4, $m5, $m6];

        $regex = "[A-Z]{2}[0-9]{4}[A-Z]{2}";

        $faker = \Faker\Factory::create();

        foreach ($modeles as $model) {
          $rand = rand(3, 5);
          for($i = 1; $i <= $rand; $i++) {

            $car = new Car();
            $car->setRegistration($faker->randomLetter() . $faker->randomLetter() . $faker->numberBetween($min = 1000, $max = 9000)  . $faker->randomLetter() . $faker->randomLetter())
                ->setNumberDoors($faker->randomElement($array = array(2,4)))
                ->setYear($faker->numberBetween($min = 1910, $max = 1970))
                ->setModel($model);
            $manager->persist($car);
          }
      }

        $manager->flush();
}

}
