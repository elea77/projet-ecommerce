<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Platform;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $repository = $this->getDoctrine()->getRepository(Game::class);
        $games = $repository -> findAll();

        return $this->render('game/home.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * @Route("/game/{id}", name="infoGame")
     */
    public function infoGame($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $game = $manager->find(Game::class, $id);

        $repoPlatform = $this->getDoctrine()->getRepository(Platform::class);
        $platform = $repoPlatform->platformGame($id);

        return $this->render('game/infoGame.html.twig', [
            'game' => $game,
            'platform' => $platform
        ]);
    }
}
