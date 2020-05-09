<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i<20; $i++){
            $product = new Product();
            $product->setTitle("Peinture bleu scnadinave");
            $product->setDescription("peinture dulux valentine a moitié plein");
            $product->setPrice(10);
            $product->setDateCreated(new \DateTime());
            $product->setActive(true);
            $product->setPicture(__DIR__.'/../../../CoupDPot/public/uploads/productPictures/default_product_picture.png');
            $product->setRegion("Pays de la Loire");
            $product->setDepartement("Vendée-85");
            $product->setUser($this->getReference("user".rand(0,9)));
            $product->setBrand($this->getReference("brand".rand(0,5)));
            $product->setCategory($this->getReference("category".rand(0,2)));
            $product->setColour($this->getReference("colour".rand(0,5)));
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
