<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Platform;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function infoGame($id, Request $request)
    {   
        $user = $this->getUser();

        $manager = $this->getDoctrine()->getManager();
        $game = $manager->find(Game::class, $id);

        $repoPlatform = $this->getDoctrine()->getRepository(Platform::class);
        $platform = $repoPlatform->platformGame($id);
        
        $repo = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repo->commentGame($id);

        $comment = new Comment;

        $form = $this -> createForm(CommentType::class, $comment);
        $form -> handleRequest($request);
        
        if ($form -> isSubmitted() && $form -> isValid()) {
            $manager = $this -> getDoctrine() -> getManager();
			
            $manager -> persist($comment);
            $comment -> setDate(new \DateTime('now'));
            $comment -> setIdGame($game);
            $comment -> setIdUser($user);

            $manager -> flush();
        }

        return $this->render('game/infoGame.html.twig', [
            'game' => $game,
            'platform' => $platform,
            'commentForm' => $form -> createView(),
            'comments' => $comments
        ]);
    }
}
