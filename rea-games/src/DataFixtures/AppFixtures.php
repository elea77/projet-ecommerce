<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Game;
use App\Entity\Platform;
use App\Entity\Note;
use App\Entity\Comment;
use App\Entity\Invoice;
use App\Entity\Purchase;

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

        $batman = new User();
        $batman->setEmail("batmanofficiel@gotham.com");
        $batman->setRole("ROLE_USER");
        $batman->setPassword("passwordbatman");
        $password = $batman -> getPassword();
        $newPassword = $this->encoder-> encodePassword($batman, $password);
        $batman -> setPassword($newPassword);
        $batman->setUsername("Batman");
        $batman->setFirstname("Bruce");
        $batman->setLastname("Wayne");
        $batman->setAvatar("batman.png");
        $batman->setBirthday(new \DateTime('1915-04-17'));
        $batman->setRegisterDate(new \DateTime('2019-08-02'));
        $batman->setBalance(2000);
        $manager->persist($batman);

        $ironman = new User();
        $ironman->setEmail("therealironman@riche.com");
        $ironman->setRole("ROLE_USER");
        $ironman->setPassword("ironpassword");
        $password = $ironman -> getPassword();
        $newPassword = $this->encoder-> encodePassword($ironman, $password);
        $ironman -> setPassword($newPassword);
        $ironman->setUsername("Iron Man");
        $ironman->setFirstname("Tony");
        $ironman->setLastname("Stark");
        $ironman->setAvatar("ironman.png");
        $ironman->setBirthday(new \DateTime('1963-03-01'));
        $ironman->setRegisterDate(new \DateTime('2017-10-27'));
        $ironman->setBalance(4000);
        $manager->persist($ironman);
        
        $game1 = new Game();
        $game1->setName("Tom Clancy's Rainbow Six Siege");
        $game1->setDescription("Rainbow Six Siege est un jeu de tir tactique où le joueur incarne différents agents de plusieurs unités de forces spéciales et de groupes d'interventions qui constituent l’équipe Rainbow. Comme les autres titres de la série, il se concentre fortement sur le jeu en équipe et le réalisme des interventions. Cependant, il existe de grandes différences par rapport à d'anciennes versions du jeu, avec un accent multijoueur important et des environnements entièrement destructibles.");
        $game1->setImg1("r6-h.jpeg");
        $game1->setImg2("Rainbow6-v.png");
        $game1->setQuantity(200);
        $game1->setPrice(59.99);
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
        $game5->setCode("g5CoDBo4");
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

        $game11 = new Game();
        $game11->setName("Call of Duty : Advanced Warfare");
        $game11->setDescription("Advanced Warfare fait partie de la série Call of Duty. Advanced Warfare met en scène d'impressionnants champs de bataille futuristes, où la technologie et les tactiques ont évolué et signé l'avènement d'une nouvelle ère du combat. L'acteur oscarisé Kevin Spacey livre une performance éblouissante dans le rôle de Jonathan Irons, l'un des hommes les plus puissants du monde, et donne ainsi corps à cette vision effrayante de la guerre du futur.");
        $game11->setImg1("advanced_warfare-h.png");
        $game11->setImg2("advanced_warfare-v.png");
        $game11->setQuantity(20);
        $game11->setPrice(9.99);
        $game11->setCode("g11CoDAW");
        $manager->persist($game11);

        $game12 = new Game();
        $game12->setName("Call of Duty : Black Ops I");
        $game12->setDescription("Call of Duty: Black Ops vous fera voyager de conflit en conflit dans le monde entier en tant qu'agent des forces spéciales participant à des opérations confidentielles et à des guerres secrètes au coeur de la Guerre froide. ");
        $game12->setImg1("bo1-h.png");
        $game12->setImg2("bo1-v.png");
        $game12->setQuantity(35);
        $game12->setPrice(19.99);
        $game12->setCode("g12CoDBo1");
        $manager->persist($game12);

        $game13 = new Game();
        $game13->setName("Call of Duty : Black Ops II");
        $game13->setDescription("Black Ops II fait partie de la série Call of Duty. Déjouant les attentes les plus folles des fans de cette licence qui défie tous les records, Call of Duty®: Black Ops II propulse les joueurs dans un avenir proche, au milieu d'une guerre froide du XXIe siècle où la convergence de technologies et d'armes inédites a abouti à l'apparition d'un nouveau type de conflits.");
        $game13->setImg1("bo2-h.png");
        $game13->setImg2("bo2-v.png");
        $game13->setQuantity(52);
        $game13->setPrice(29.99);
        $game13->setCode("g13CoDBo2");
        $manager->persist($game13);

        $game14 = new Game();
        $game14->setName("Call of Duty : Black Ops III");
        $game14->setDescription("Bienvenue en 2065. Une nouvelle espèce de soldats Black Ops a émergé et la frontière se brouille entre l'humanité et la robotique militaire de pointe qui définit le combat du futur.");
        $game14->setImg1("bo3-h.png");
        $game14->setImg2("bo3-v.png");
        $game14->setQuantity(46);
        $game14->setPrice(19.99);
        $game14->setCode("g14CoDBo3");
        $manager->persist($game14);

        $game15 = new Game();
        $game15->setName("Call of Duty : Ghosts");
        $game15->setDescription("Ce nouveau chapitre de Call of Duty introduit une dynamique inédite qui place les joueurs dans le camp d'un pays brisé qui se bat, non pas pour la liberté, mais tout simplement pour survivre. Au sein d'un groupe mystérieux connu sous le nom de \"Ghosts\", d'anciens membres des forces spéciales mènent le combat contre une nouvelle puissance mondiale technologiquement supérieure.");
        $game15->setImg1("cod_ghosts-h.png");
        $game15->setImg2("cod_ghosts-v.png");
        $game15->setQuantity(3);
        $game15->setPrice(4.99);
        $game15->setCode("g15CoDG");
        $manager->persist($game15);

        $game16 = new Game();
        $game16->setName("Call of Duty : World War II");
        $game16->setDescription("Call of Duty retourne à ses origines avec Call of Duty: WWII, une expérience à couper le souffle qui servira de référence à la nouvelle génération de joueurs. Débarquez en Normandie pour le jour J et combattez à travers l'Europe dans les lieux emblématiques de la plus grande guerre de l'Histoire. Prenez part à des combats classiques dans la tradition Call of Duty, créez des liens de camaraderie et survivez à cette guerre impitoyable.");
        $game16->setImg1("wwii-h.png");
        $game16->setImg2("wwii-v.png");
        $game16->setQuantity(70);
        $game16->setPrice(39.99);
        $game16->setCode("g16CoDWWII");
        $manager->persist($game16);

        $game17 = new Game();
        $game17->setName("Call of Duty : Modern Warfare");
        $game17->setDescription("Le jeu se déroule dans un cadre réaliste et moderne d'où son nom. La campagne suit les officiers américains de la CIA et les SAS des forces armées britanniques, qui font équipe avec les rebelles du pays fictif d’Urzikstan pour lutter ensemble contre les forces russes qui ont envahi le pays.");
        $game17->setImg1("modern_warfare-h.png");
        $game17->setImg2("modern_warfare-v.png");
        $game17->setQuantity(200);
        $game17->setPrice(69.99);
        $game17->setCode("g17CoDMW19");
        $manager->persist($game17);

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
        $platform1->addGame($game11);
        $platform1->addGame($game12);
        $platform1->addGame($game13);
        $platform1->addGame($game14);
        $platform1->addGame($game15);
        $platform1->addGame($game16);
        $platform1->addGame($game17);
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
        $platform2->addGame($game11);
        $platform2->addGame($game12);
        $platform2->addGame($game13);
        $platform2->addGame($game14);
        $platform2->addGame($game15);
        $platform2->addGame($game16);
        $platform2->addGame($game17);
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
        $platform3->addGame($game11);
        $platform3->addGame($game12);
        $platform3->addGame($game13);
        $platform3->addGame($game14);
        $platform3->addGame($game15);
        $platform3->addGame($game16);
        $platform3->addGame($game17);
        $manager->persist($platform3);

        $note = new Note();
        $note->setIdUser($admin1);
        $note->setIdGame($game1);
        $note->setNote(3);
        $manager->persist($note);
        
        $note = new Note();
        $note->setIdUser($admin1);
        $note->setIdGame($game3);
        $note->setNote(1);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($admin1);
        $note->setIdGame($game4);
        $note->setNote(5);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($admin2);
        $note->setIdGame($game3);
        $note->setNote(4);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($admin2);
        $note->setIdGame($game4);
        $note->setNote(2);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($admin2);
        $note->setIdGame($game5);
        $note->setNote(3);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($batman);
        $note->setIdGame($game1);
        $note->setNote(5);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($batman);
        $note->setIdGame($game4);
        $note->setNote(2);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($batman);
        $note->setIdGame($game5);
        $note->setNote(1);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($ironman);
        $note->setIdGame($game3);
        $note->setNote(2);
        $manager->persist($note);

        $note = new Note();
        $note->setIdUser($ironman);
        $note->setIdGame($game4);
        $note->setNote(3);
        $manager->persist($note);


        $comment = new Comment;
        $comment -> setReview('Vous savez que je suis riche ?');
        $datetime = new \DateTime('2020-05-08 09:29:45');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game1);
        $comment -> setIdUser($ironman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Vous savez que je suis riche ?');
        $datetime = new \DateTime('2020-05-08 09:33:45');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game2);
        $comment -> setIdUser($ironman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Vous savez que je suis riche ?');
        $datetime = new \DateTime('2020-05-08 09:32:45');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game3);
        $comment -> setIdUser($ironman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Vous savez que je suis riche ?');
        $datetime = new \DateTime('2020-05-08 09:31:45');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game4);
        $comment -> setIdUser($ironman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Vous savez que je suis riche ?');
        $datetime = new \DateTime('2020-05-08 09:30:45');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game5);
        $comment -> setIdUser($ironman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Pas mal ce jeu j\'aime bien mais avec une BATMOBILE il serait bien bien meilleur.');
        $datetime = new \DateTime('2020-05-08 18:19:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game4);
        $comment -> setIdUser($batman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Ces agents sont aussi efficace que LE BATMAN. #validerParBatou');
        $datetime = new \DateTime('2020-05-08 18:19:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game1);
        $comment -> setIdUser($batman);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Il y a une ile ou il y a une armée de poulet qui nous attaque et il faut tous les tuer. Meme que l\'une d\'elle est légendaire.');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game2);
        $comment -> setIdUser($admin1);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Il ressemble beaucoup à origins mais vous fiez pas seulement à ça. Les développeurs ont repris les qualités du précédent AC et ont améliorés le reste. Et la Grèce Antique est magnifique à explorer !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game2);
        $comment -> setIdUser($admin1);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('J\'ai jamais joué à un HAlo de ma vie. !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game4);
        $comment -> setIdUser($admin1);
        $manager -> persist($comment);


        $comment = new Comment;
        $comment -> setReview('Faut croire que j\'aime COD vu que j\'ai mis 50 jeux COD sur le site !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game5);
        $comment -> setIdUser($admin2);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('Woaw j\'adore la relation père fils qu\'il y a entre Kratos et son fils.');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game3);
        $comment -> setIdUser($admin2);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('COD TROP BIEN !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game5);
        $comment -> setIdUser($admin2);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('COD TROP TROP BIEN !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game5);
        $comment -> setIdUser($admin2);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('COD TROP TROP TROP BIEN !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game5);
        $comment -> setIdUser($admin2);
        $manager -> persist($comment);

        $comment = new Comment;
        $comment -> setReview('COD TROP TROP TROP TROP BIEN !');
        $datetime = new \DateTime('2020-06-02 22:22:22');
        $comment -> setDate($datetime);
        $comment -> setIdGame($game5);
        $comment -> setIdUser($admin2);
        $manager -> persist($comment);


        $invoice1 = new Invoice;
        $invoice1 -> setIdUser($admin1);
        $invoice1 -> setCost(299.95);
        $invoice1 -> setDocumentName('Rémi_KARMANN_06-06-2020_11-06_85');
        $datetime = new \DateTime('2020-06-06 11:59:1');
        $invoice1 -> setDate($datetime);
        $manager -> persist($invoice1);

        $purchase = new Purchase;
        $purchase -> setUser($admin1);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game1);
        $purchase -> setInvoice($invoice1);
        $purchase -> setPlatform($platform1);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin1);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game2);
        $purchase -> setInvoice($invoice1);
        $purchase -> setPlatform($platform2);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin1);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game3);
        $purchase -> setInvoice($invoice1);
        $purchase -> setPlatform($platform1);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin1);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(2);
        $purchase -> setGame($game4);
        $purchase -> setInvoice($invoice1);
        $purchase -> setPlatform($platform2);
        $manager -> persist($purchase);


        $invoice2 = new Invoice;
        $invoice2 -> setIdUser($admin2);
        $invoice2 -> setCost(319.94);
        $invoice2 -> setDocumentName('Eléa_CARTON_06-06-2020_12-06_19');
        $datetime = new \DateTime('2020-06-06 12:11:08');
        $invoice2 -> setDate($datetime);
        $manager -> persist($invoice2);

        $purchase = new Purchase;
        $purchase -> setUser($admin2);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game3);
        $purchase -> setInvoice($invoice2);
        $purchase -> setPlatform($platform1);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin2);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game4);
        $purchase -> setInvoice($invoice2);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin2);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(2);
        $purchase -> setGame($game5);
        $purchase -> setInvoice($invoice2);
        $purchase -> setPlatform($platform1);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin2);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game5);
        $purchase -> setInvoice($invoice2);
        $purchase -> setPlatform($platform2);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($admin2);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game5);
        $purchase -> setInvoice($invoice2);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);


        $invoice3 = new Invoice;
        $invoice3 -> setIdUser($batman);
        $invoice3 -> setCost(219.96);
        $invoice3 -> setDocumentName('Bruce_Wayne_06-06-2020_12-06_83');
        $datetime = new \DateTime('2020-06-06 12:24:01');
        $invoice3 -> setDate($datetime);
        $manager -> persist($invoice3);

        $purchase = new Purchase;
        $purchase -> setUser($batman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(2);
        $purchase -> setGame($game1);
        $purchase -> setInvoice($invoice3);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($batman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game4);
        $purchase -> setInvoice($invoice3);
        $purchase -> setPlatform($platform2);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($batman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game5);
        $purchase -> setInvoice($invoice3);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);


        $invoice4 = new Invoice;
        $invoice4 -> setIdUser($ironman);
        $invoice4 -> setCost(299.95);
        $invoice4 -> setDocumentName('Tony_Stark_06-06-2020_12-06_83');
        $datetime = new \DateTime('2020-06-06 12:38:01');
        $invoice4 -> setDate($datetime);
        $manager -> persist($invoice4);

        $purchase = new Purchase;
        $purchase -> setUser($ironman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game1);
        $purchase -> setInvoice($invoice4);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($ironman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game2);
        $purchase -> setInvoice($invoice4);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($ironman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game3);
        $purchase -> setInvoice($invoice4);
        $purchase -> setPlatform($platform1);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($ironman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game4);
        $purchase -> setInvoice($invoice4);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);

        $purchase = new Purchase;
        $purchase -> setUser($ironman);
        $purchase -> setDate(new \DateTime('2020-06-06'));
        $purchase -> setQuantity(1);
        $purchase -> setGame($game5);
        $purchase -> setInvoice($invoice4);
        $purchase -> setPlatform($platform3);
        $manager -> persist($purchase);

        $manager->flush();
    }
}
