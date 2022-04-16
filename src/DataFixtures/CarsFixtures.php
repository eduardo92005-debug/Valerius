<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CarsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 4; $i++) {
            $car = new Cars();
            $car->setName('Car ' . $i);
            $car->setPrice(rand(100, 1000));
            $car->setYear(rand(2000, 2020));
            $car->setModel('Model ' . $i);
            $car->setColor('Color ' . $i);
            $car->setImageName('car_' . $i . '.jpg');
            $car->setTag('chevrolet ' . $i);
            $car->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($car);
        }

        $manager->flush();
    }
}
