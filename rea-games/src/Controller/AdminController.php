<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Game;
use App\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

use App\Form\UserType;
use App\Form\GameImg1Type;
use App\Form\GameImg2Type;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $nbUsers = $repository -> nbUsers();

        $repository = $this->getDoctrine()->getRepository(Invoice::class);
        $invoices = $repository -> findAll();

        $nbInvoice = 0;
        $revenu = 0;
        foreach($invoices as $invoice){
            $nbInvoice += 1;
            $revenu += $invoice->getCost();
        }

        return $this->render('admin/dashboard.html.twig', [
            'nbUsers' => $nbUsers,
            'nbInvoice' => $nbInvoice,
            'revenu' => $revenu
        ]);
    }

    /**
     * @Route("/admin/members", name="members")
     */
    public function members(PaginatorInterface $paginator, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $donnees = $repository -> listUsers();

        $users = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            8 // Nombre de résultats par page
        );

        return $this->render('admin/members.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/deleteMembers/{id}", name="deleteMembers")
     */
    public function deleteMembers($id)
    {
        $member = $this->getDoctrine()->getRepository(User::class)->find($id);
        $manager = $this -> getDoctrine() -> getManager();
        $manager->remove($member);
        $manager->flush();

        return $this->redirectToRoute('members');
    }

    /**
     * @Route("/admin/games", name="games")
     */
    public function games(PaginatorInterface $paginator, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Game::class);
        $donnees = $repository -> findAll();

        $games = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            8 // Nombre de résultats par page
        );

        return $this->render('admin/games.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * @Route("/admin/deleteGame/{id}", name="deleteGame")
     */
    public function deleteGame($id)
    {
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);
        $manager = $this -> getDoctrine() -> getManager();
        $manager->remove($game);
        $manager->flush();

        return $this->redirectToRoute('games');
    }

    /**
     * @Route("/admin/updateGame/{id}", name="updateGame")
     */
    public function updateGame($id, Request $request)
    {
        $game = $this->getDoctrine()->getRepository(Game::class)->find($id);

        $form1 = $this -> createForm(GameImg1Type::class, $game);
        $form1 -> handleRequest($request);
        $form2 = $this -> createForm(GameImg2Type::class, $game);
        $form2 -> handleRequest($request);

        if(isset($_POST['submit'])) {
            $newName = $_POST['newName'];
            $newDesc = $_POST['newDesc'];
            $newPrice = $_POST['newPrice'];
            $game -> setName($newName);
            $game -> setPrice($newPrice);
            $game -> setDescription($newDesc);
 
            $manager = $this-> getDoctrine() -> getManager();
            $manager -> persist($game); //commit(git)
            $manager -> flush(); // push(git)
            return $this -> redirectToRoute('games');
        }

        $game_id = $game -> getId();

        if($form1 -> isSubmitted() && $form1 -> isValid()){          

            $file1 = $game->getImg1();
            $filename1 = 'image_' . time() . '_' . $game_id . '_' . rand(1,9999) . '.' . $file1->guessExtension();
            $file1->move($this->getParameter('upload_game_img'), $filename1);
            $game-> setImg1($filename1);

            $manager = $this-> getDoctrine() -> getManager();
            $manager -> persist($game); //commit(git)
            $manager -> flush(); // push(git)
            $this -> addFlash('success','Les informations ont été modifié avec succès !');
        }

        if($form2 -> isSubmitted() && $form2 -> isValid()){

            $file2 = $game->getImg2();
            $filename2 = 'image_' . time() . '_' . $game_id . '_' . rand(1,9999) . '.' . $file2->guessExtension();
            $file2->move($this->getParameter('upload_game_img'), $filename2);
            $game-> setImg2($filename2);

            $manager = $this-> getDoctrine() -> getManager();
            $manager -> persist($game); //commit(git)
            $manager -> flush(); // push(git)
            $this -> addFlash('success','Les informations ont été modifié avec succès !');
        }

        return $this->render('admin/updateGame.html.twig', [
            'game' => $game,
            'form1'=> $form1 -> createView(),
            'form2'=> $form2 -> createView()
        ]);
    }

    /**
     * @Route("/admin/admins", name="admins")
     */
    public function admins(PaginatorInterface $paginator, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $donnees = $repository ->findBy(['role' => 'ROLE_ADMIN']);

        $admins = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            6 // Nombre de résultats par page
        );

        return $this->render('admin/admins.html.twig', [
            'admins' => $admins
        ]);
    }

    /**
     * @Route("/admin/createAdmin", name="createAdmin")
     */
    public function createAdmin(UserPasswordEncoderInterface $encoder, Request $request)
    {
        $admin = new User;

        $form = $this -> createForm(UserType::class, $admin);
        $form -> handleRequest($request);
        
        if ($form -> isSubmitted() && $form -> isValid()) {
            try{
                $manager = $this -> getDoctrine() -> getManager();
			
                $manager -> persist($admin);
                $admin -> setRole('ROLE_ADMIN');
                $admin -> setBalance(0);
                $admin -> setAvatar('user.png');
                $admin -> setRegisterDate(new \DateTime('now'));
                $password = $admin -> getPassword();
                $newPassword = $encoder -> encodePassword($admin, $password);
                $admin -> setPassword($newPassword);

                $manager -> flush();
                return $this -> redirectToRoute('admins');
            }catch(\Doctrine\DBAL\DBALException $e) 
            {
                if( $e->getPrevious()->getCode() === '23000' )
                {
                    $this -> addFlash('errors', 'Cette adresse mail est déjà utilisée !');
                }

                else throw $e;    
            }
        }

        return $this->render('admin/createAdmin.html.twig', [
            'userForm' => $form -> createView()
        ]);
    }

}
