<?php

namespace App\Controller;

use App\Data\RechercheCriteria;
use App\Entity\Brand;
use App\Entity\Colour;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="main_")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ProductRepository $pr, EntityManagerInterface $em, Request $req)
    {
        $criteria = $this->buildCriteria($req, $em);
        $annonces = $em->getRepository(Product::class)->findProductsFiltered($criteria);
        dump($criteria);
        $colors = $em->getRepository(Colour::class)->findAll();
        $brands = $em->getRepository(Brand::class)->findAll();
        dump($annonces);
        return $this->render('main/home.html.twig', [
            "criteria" => $criteria,
            "annonces" => $annonces,
            "brands" => $brands,
            "colors" => $colors
        ]);
    }

    public function buildCriteria(Request $req, EntityManagerInterface $em){
        $criteria = new RechercheCriteria();
        if($req->query->get('search')){
            $criteria->setSearch($req->query->get('search'));
        }
        if($req->query->get('couleur') != "" && $req->query->get('couleur') != null){
            if($req->query->get('couleur') == "All"){

            }else{
                $idColour = $req->query->get('couleur');
                $colour = $em->getRepository(Colour::class)->find($idColour);
                $criteria->setColour($colour);
            }
        }
        if($req->query->get('marque') != "" && $req->query->get('marque') != null){
            if($req->query->get('marque') == "All"){

            }else{
                $idMarque = $req->query->get('marque');
                $marque = $em->getRepository(Brand::class)->find($idMarque);
                $criteria->setBrand($marque);
            }
        }

        if($req->query->get('region') != "" && $req->query->get('region') != null) {
            if ($req->query->get('region') == "All") {
            } else {
                $criteria->setRegion($req->query->get('region'));
            }
        }
        if($req->query->get('departement') != "" && $req->query->get('departement') != null) {
            if ($req->query->get('departement') == "All") {
            } else {
                $criteria->setDepartement($req->query->get('departement'));
            }
        }
        if($req->query->get('interieure')){
            $criteria->setInterieure(true);
        }
        if($req->query->get('exterieure')){
            $criteria->setExterieure(true);
        }
        if($req->query->get('outils')){
            $criteria->setOutils(true);
        }

        return $criteria;
    }
}
