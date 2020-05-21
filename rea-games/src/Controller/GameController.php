<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('game/home.html.twig', []);
    }

    /**
     * @Route("/game/{id}", name="infoGame")
     */
    public function infoGame()
    {
        return $this->render('game/infoGame.html.twig', []);
    }
}
