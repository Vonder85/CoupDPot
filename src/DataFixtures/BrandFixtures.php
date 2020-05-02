<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $i =0;
        $brand = new Brand();
        $brand->setName('Dulux Valentine');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);
        $i++;

        $brand = new Brand();
        $brand->setName('Luxens');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);
        $i++;

        $brand = new Brand();
        $brand->setName('Tollens');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);
        $i++;

        $brand = new Brand();
        $brand->setName('Ripolin');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);
        $i++;

        $brand = new Brand();
        $brand->setName('Keim');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);
        $i++;

        $brand = new Brand();
        $brand->setName('GoodHome');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);
        $i++;

        $brand = new Brand();
        $brand->setName('Autre');
        $this->addReference("brand".$i, $brand);
        $manager->persist($brand);


        $manager->flush();
    }
}
