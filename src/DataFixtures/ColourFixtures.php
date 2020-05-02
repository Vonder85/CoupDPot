<?php

namespace App\DataFixtures;

use App\Entity\Colour;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColourFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i = 0;
        $colour = new Colour();
        $colour->setName('Bleu');
        $this->addReference("colour".$i, $colour);
        $manager->persist($colour);
        $i++;

        $colour = new Colour();
        $colour->setName('Rouge');
        $this->addReference("colour".$i, $colour);
        $manager->persist($colour);
        $i++;

        $colour = new Colour();
        $colour->setName('Vert');
        $this->addReference("colour".$i, $colour);
        $manager->persist($colour);
        $i++;

        $colour = new Colour();
        $colour->setName('Gris');
        $this->addReference("colour".$i, $colour);
        $manager->persist($colour);
        $i++;

        $colour = new Colour();
        $colour->setName('Blanc');
        $this->addReference("colour".$i, $colour);
        $manager->persist($colour);
        $i++;

        $colour = new Colour();
        $colour->setName('Autre');
        $this->addReference("colour".$i, $colour);
        $manager->persist($colour);
        $i++;

        $manager->flush();
    }
}
