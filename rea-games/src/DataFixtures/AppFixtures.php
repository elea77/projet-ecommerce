<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\decimal;
use App\Entity\User;
use App\Entity\Game;
use App\Entity\Platform;

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
        $admin1->setAvatar("user.png");
        $admin1->setBirthday(new \DateTime('2000-05-08'));
        $admin1->setRegisterDate(new \DateTime('2020-05-20'));
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
        $admin2->setAvatar("user.png");
        $admin2->setBirthday(new \DateTime('2000-07-20'));
        $admin2->setRegisterDate(new \DateTime('2020-05-20'));
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
            $user->setAvatar("user.png");
            $user->setBirthday(new \DateTime('2000-10-10'));
            $user->setRegisterDate(new \DateTime('2020-05-20'));
            $user->setBalance(175);
            $manager->persist($user);
        }
        
        $game1 = new Game();
        $game1->setName("Tom Clancy's Rainbow Six Siege");
        $game1->setDescription("Rainbow Six Siege est un jeu de tir tactique où le joueur incarne différents agents de plusieurs unités de forces spéciales et de groupes d'interventions qui constituent l’équipe Rainbow. Comme les autres titres de la série, il se concentre fortement sur le jeu en équipe et le réalisme des interventions. Cependant, il existe de grandes différences par rapport à d'anciennes versions du jeu, avec un accent multijoueur important et des environnements entièrement destructibles.");
        $game1->setImg1("r6-h.jpeg");
        $game1->setImg2("Rainbow6-v.png");
        $game1->setQuantity(200);
        $game1->setPrice(decimale(59,99));
        $game1->setCode("g1R6TC");
        $manager->persist($game1);


        $game2 = new Game();
        $game2->setName("Assassin's Creed Odyssey");
        $game2->setDescription("Assassin's Creed Odyssey est un jeu vidéo d'action-aventure et de rôle. L’histoire d’Assassin’s Creed Odyssey se déroule en 431 avant J.-C., au début de la guerre du Péloponnèse. Il raconte la quête de réponses des deux héros (au choix, Alexios et Kassandra), mercenaires spartiates hantés par une tragédie familiale.");
        $game2->setImg1("assassins-creed-odyssey-h.jpg");
        $game2->setImg2("assassins-creed-odyssey-v.jpg");
        $game2->setQuantity(180);
        $game2->setPrice(69.99);
        $game2->setCode("g2ACO");
        $manager->persist($game2);


        $game3 = new Game();
        $game3->setName("God of War");
        $game3->setDescription("God of War est une série de jeux vidéo d'action-aventure. Le joueur incarne un redoutable guerrier, Kratos, qui se retrouve confronté à un grand nombre d'ennemis. Le joueur dispose d'une large palette de coups, avec de nombreux enchaînements possibles. Les combats sont régulièrement entrecoupés d'attaques contextuelles à la mise en scène préétablie.");
        $game3->setImg1("godofwar-h.jpg");
        $game3->setImg2("godofwar-v.jpg");
        $game3->setQuantity(180);
        $game3->setPrice(69.99);
        $game3->setCode("g3GOW");
        $manager->persist($game3);


        $game4 = new Game();
        $game4->setName("Halo : The Master Chief Collection");
        $game4->setDescription("Halo: The Master Chief Collection est un jeu vidéo de la série Halo regroupant une version haute définition des opus Halo: Combat Evolved, Halo 2, Halo 3 et Halo 4, ainsi qu'un accès à la bêta d’Halo 5: Guardians. Chaque épisode remastérisé reprend le gameplay de l'opus respectif auquel il est associé.");
        $game4->setImg1("halo-h.jpg");
        $game4->setImg2("halo-v.png");
        $game4->setQuantity(100);
        $game4->setPrice(49.99);
        $game4->setCode("g4HMCC");
        $manager->persist($game4);

        $game5 = new Game();
        $game5->setName("Call of Duty : Black Ops IIII");
        $game5->setDescription("Call of Duty: Black Ops IIII est un jeu vidéo de tir à la première personne. Il s'agit du 15e épisode de la série Call of Duty et 4e opus de la série Black Ops. BO4 propose trois modes de jeu : Multijoueur, Blackout et Zombies.");
        $game5->setImg1("bo4-h.png");
        $game5->setImg2("bo4-v.png");
        $game5->setQuantity(80);
        $game5->setPrice(49.99);
        $game5->setCode("g5CODBO4");
        $manager->persist($game5);

        $game6 = new Game();
        $game6->setName("Uncharted 4 : A Thief's End");
        $game6->setDescription("Quatrième opus de la série de jeu d'action/aventure à succès de Naughty Dog, Uncharted 4 A Thief's End vous permet d'incarner Nathan Drake pour la première fois sur PS4. Le célèbre explorateur devra révéler le complot qui se cache derrière un légendaire trésor de pirates.");
        $game6->setImg1("uncharted4-h.png");
        $game6->setImg2("uncharted4-v.png");
        $game6->setQuantity(60);
        $game6->setPrice(19.99);
        $game6->setCode("g6U4ATE");
        $manager->persist($game6);

        $game7 = new Game();
        $game7->setName("Mortal Kombat 11");
        $game7->setDescription("Mortal Kombat 11, développé par NetherRealm Studios et édité par Warner Bros. Games, est le dernier venu de la saga des jeux de combat Mortal Kombat. Ce dernier prévoit une customisation poussée pour créer de nombreuses variations de Kombattants.");
        $game7->setImg1("mk11-h.png");
        $game7->setImg2("mk11-v.png");
        $game7->setQuantity(100);
        $game7->setPrice(29.99);
        $game7->setCode("g7MK11");
        $manager->persist($game7);

        $game8 = new Game();
        $game8->setName("Monster Hunter World");
        $game8->setDescription("Monster Hunter World est un jeu vidéo d'action-RPG. Le jeu reprend le principe de jeu de base des précédents épisodes de la série Monster Hunter, tout en ajoutant de nouvelles mécaniques de jeu comme les navicioles ou les contrats, aussi nommées investigations, et des améliorations de confort de jeu comme les descriptions des différents talents qui permettent d'augmenter les statistiques du joueur. Le but est de chasser des monstres, seul ou en coopération jusqu'à 4 joueurs.");
        $game8->setImg1("mhw-h.png");
        $game8->setImg2("mhw-v.png");
        $game8->setQuantity(100);
        $game8->setPrice(30.00);
        $game8->setCode("g8MHW");
        $manager->persist($game8);

        $game9 = new Game();
        $game9->setName("Detroit: Become Human");
        $game9->setDescription("Detroit : Become Human est un jeu d’aventure-action développé par Quantic Dream. Le joueur pourra incarner 3 personnages différents évoluant chacun de leur côté au sein d'histoires s'entrecoupant les unes les autres. L'action se déroule à Detroit, la ville abritant le principal site de production d'androïdes.");
        $game9->setImg1("detroit-h.png");
        $game9->setImg2("detroit-v.png");
        $game9->setQuantity(120);
        $game9->setPrice(39.99);
        $game9->setCode("g9DBH");
        $manager->persist($game9);

        $game10 = new Game();
        $game10->setName("Final Fantasy VII Remake");
        $game10->setDescription("Final Fantasy VII Remake est le remake de Final Fantasy VII. Le joueur y incarne toujours Cloud, un ancien soldat ayant rejoint le groupe terroriste Avalanche. Ce dernier essaye de déjouer les plans de la Shinra et en vient à se battre avec Sephiroth.");
        $game10->setImg1("final-fantasy-vii-h.png");
        $game10->setImg2("final-fantasy-vii-v.png");
        $game10->setQuantity(220);
        $game10->setPrice(69.99);
        $game10->setCode("g10FFviiR");
        $manager->persist($game10);


        $platform1 = new Platform();
        $platform1->setName("PlayStation");
        $platform1->addGame($game1);
        $platform1->addGame($game2);
        $platform1->addGame($game3);
        $platform1->addGame($game5);
        $platform1->addGame($game6);
        $platform1->addGame($game7);
        $platform1->addGame($game8);
        $platform1->addGame($game9);
        $platform1->addGame($game10);
        $manager->persist($platform1);

        $platform2 = new Platform();
        $platform2->setName("Xbox");
        $platform2->addGame($game1);
        $platform2->addGame($game2);
        $platform2->addGame($game4);
        $platform2->addGame($game5);
        $platform2->addGame($game7);
        $platform2->addGame($game8);
        $platform2->addGame($game9);
        $platform2->addGame($game10);
        $manager->persist($platform2);

        $platform3 = new Platform();
        $platform3->setName("PC");
        $platform3->addGame($game1);
        $platform3->addGame($game2);
        $platform3->addGame($game4);
        $platform3->addGame($game5);
        $platform3->addGame($game7);
        $platform3->addGame($game8);
        $platform3->addGame($game9);
        $platform3->addGame($game10);
        $manager->persist($platform3);


        $manager->flush();
    }
}
