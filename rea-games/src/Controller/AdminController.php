<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Knp\Component\Pager\PaginatorInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $nbUsers = $repository -> nbUsers();

        return $this->render('admin/dashboard.html.twig', [
            'nbUsers' => $nbUsers
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
}
