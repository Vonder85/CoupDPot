<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i=0;
        $category = new Category();
        $category->setName('Peinture intérieure');
        $this->addReference("category".$i, $category);
        $manager->persist($category);
        $i++;

        $category = new Category();
        $category->setName('Peinture extérieure');
        $this->addReference("category".$i, $category);
        $manager->persist($category);
        $i++;

        $category = new Category();
        $category->setName('Outils du peintre');
        $this->addReference("category".$i, $category);
        $manager->persist($category);

        $manager->flush();
    }
}
