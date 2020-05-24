<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function members()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository -> listUsers();

        return $this->render('admin/members.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/admin/games", name="games")
     */
    public function games()
    {
        $repository = $this->getDoctrine()->getRepository(Game::class);
        $games = $repository -> listGames();

        return $this->render('admin/games.html.twig', [
            'games' => $games
        ]);
    }
}
