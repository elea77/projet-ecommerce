<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('admin/dashboard.html.twig', []);
    }

    /**
     * @Route("/admin/members", name="members")
     */
    public function members()
    {
        return $this->render('admin/members.html.twig', []);
    }

    /**
     * @Route("/admin/games", name="games")
     */
    public function games()
    {
        return $this->render('admin/games.html.twig', []);
    }
}
