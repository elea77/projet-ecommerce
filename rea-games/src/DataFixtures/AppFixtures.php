<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin1 = new User();
        $admin1->setEmail("remi.karmann@ynov.com");
        $admin1->setRole("ROLE_ADMIN");
        $admin1->setPassword("passwordadmin");
        $password = $admin1 -> getPassword();
		$newPassword = $this->encoder-> encodePassword($admin1, $password);
		$admin1 -> setPassword($newPassword);
        $admin1->setUsername("Alainproviste");
        $admin1->setFirstname("Rémi");
        $admin1->setLastname("KARMANN");
        $admin1->setBirthday(new \DateTime('2000-05-08'));
        $admin1->setBalance(450);
        $manager->persist($admin1);

        $admin2 = new User();
        $admin2->setEmail("elea.carton@ynov.com");
        $admin2->setRole("ROLE_ADMIN");
        $admin2->setPassword("passwordadmin");
        $password = $admin2 -> getPassword();
		$newPassword = $this->encoder-> encodePassword($admin2, $password);
		$admin2 -> setPassword($newPassword);
        $admin2->setUsername("Catwoghost");
        $admin2->setFirstname("Eléa");
        $admin2->setLastname("CARTON");
        $admin2->setBirthday(new \DateTime('2000-07-20'));
        $admin2->setBalance(500);
        $manager->persist($admin2);

        for ($count = 0; $count < 3; $count++) {
            $user = new User();
            $user->setEmail("emailUser" . $count . "@ynov.com");
            $user->setRole("ROLE_USER");
            $user->setPassword("passworduser" . $count);
            $password = $user -> getPassword();
            $newPassword = $this->encoder-> encodePassword($user, $password);
            $user -> setPassword($newPassword);
            $user->setUsername("User" . $count);
            $user->setFirstname("FirstnameUser" . $count);
            $user->setLastname("LastnameUser" . $count);
            $user->setBirthday(new \DateTime('2000-10-10'));
            $user->setBalance(175);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
