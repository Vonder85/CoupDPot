<?php

namespace App\Controller;

use App\Data\RechercheCriteria;
use App\Entity\Brand;
use App\Entity\Colour;
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
        return $this->render('main/home.html.twig', [
        ]);
    }

    public function buildCriteria(Request $req, EntityManagerInterface $em){
        $criteria = new RechercheCriteria();
        if($req->query->get('search')){
            $criteria->setSearch($req->query->get('search'));
        }
        if($req->query->get('couleur') == "all"){

        }else{
            $idColour = $req->query->get('colour');
            $colour = $em->getRepository(Colour::class)->find($idColour);
            $criteria->setColour($colour);
        }
        if($req->query->get('marque') == "all"){

        }else{
            $idMarque = $req->query->get('marque');
            $marque = $em->getRepository(Brand::class)->find($idMarque);
            $criteria->setBrand($marque);
        }
        if($req->query->get('region') == "all"){

        }else{
            $criteria->setColour($req->query->get('region'));
        }
        if($req->query->get('departement') == "all"){

        }else{
            $criteria->setColour($req->query->get('departement'));
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
