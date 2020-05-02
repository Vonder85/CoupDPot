<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i<10; $i++){
            $user = new User();
            $user->setUsername("user".$i);
            $user->setLastname("user".$i);
            $user->setFirstname("user".$i);
            $password=$this->encoder->encodePassword($user,$i);
            $user->setPassword($password);
            $user->setPhoto("default_profile_pic_fixtures.png");
            $user->setRoles(['ROLE_USER']);
            $user->setEmail("user".$i."@mail.com");
            $user->setDateCreated(new \DateTime());
            $user->setPhone("06".rand(0,8)."6469".rand(0,9)."0".rand(0,9));
            $user->setZip("85270");
            $user->setCity("Saint-Hilaire-De-Riez");
            $this->addReference("user".$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
