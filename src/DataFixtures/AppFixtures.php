<?php

namespace App\DataFixtures;

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
        $manager->persist($b2);

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

        $manager->flush();
    }
}
