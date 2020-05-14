<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * Méthode permettant d'enregistrer un utilisateur
     * @Route("/Inscription", name="user_register")
     */
    public function register(EntityManagerInterface $em, UserRepository $ur, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $registerForm = $this->createForm(RegisterType::class, $user);
        $user->setDateCreated(new \DateTime());
        $user->setRoles(['ROLE_USER']);

        $registerForm->handleRequest($request);
        if($registerForm->isSubmitted() && $registerForm->isValid() ){
            //Hasher le password
            $hashed = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hashed);

            $photo = $registerForm->get('photo')->getData();
            if($photo){
                $photoName = $this->generateUniqueFileName() . '.' . strtolower($photo->getClientOriginalExtension());
                $photo->move(
                  $this->getParameter('upload_photos_profile'),
                  $photoName
                );
                $user->setPhoto($photoName);
            }else{
                $user->setPhoto('default_profile_pic_fixtures.png');
            }

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('main_home');
        }
        return $this->render('user/register.html.twig', [
            "registerForm" => $registerForm->createView(),
        ]);
    }

    /**
     * permet la connexion
     * @Route("/Connexion", name="Connexion")
     */
    public function login(AuthenticationUtils $au){
        $error = $au->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $au->getLastUsername();

        return $this->render('user/login.html.twig', [
            "error" => $error,
            "lastusername" => $lastUsername,
        ]);
    }

    /**
     * permet la deconnexion
     * @Route("/Deconnexion", name="Deconnexion")
     */
    public function logout(){}

    /**
     * fonction qui affiche et permet de moodifier son profil
     * @Route("/Profil/{id}/{csrf}", name="user_profile", requirements={"id": "\d+"})
     */
    public function showProfile($id, $csrf, UserRepository $ur, Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em){
        if (!$this->isCsrfTokenValid('user_profile_' . $id, $csrf)) {
            throw $this->createAccessDeniedException('Désolé, votre session a expiré !');
        } else {
            $user = $ur->find($id);
            $profileForm = $this->createForm(RegisterType::class, $user);
            $photoActuelle = $user->getPhoto();

            $profileForm->handleRequest($request);
            if($profileForm->isSubmitted() && $profileForm->isValid()){
                //hasher le mot de passe
                $hashed = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($hashed);

                $photo = $profileForm->get('photo')->getData();
                if ($photo) {
                    $photoName = $this->generateUniqueFileName() . '.' . strtolower($photo->getClientOriginalExtension());
                    $photo->move(
                        $this->getParameter('upload_photos_profile'),
                        $photoName
                    );
                    $user->setPhoto($photoName);
                } else {
                    $user->setPhoto($photoActuelle);
                }
                $em->flush();
                $this->addFlash('success', 'Profil modifié');
            }
        }
        return $this->render('user/profile.html.twig', [
            "profileForm" => $profileForm->createView(),
        ]);
    }

    /**
     * Renvoit la page de ses ventes
     * @Route("/MesVentes", name="user_sells")
     */
    public function mySells(ProductRepository $pr){
        $products = $pr->findProductsOfOneUser($this->getUser()->getId());
        dump($products);
        return $this->render('user/mySells.html.twig', [
            "products"=>$products
        ]);
    }

    /**
     * Méthode permettant de renvoyer un nom unique pour la photo de profil
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
