<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Platform;
use App\Entity\Comment;
use App\Entity\Note;
use App\Form\CommentType;
use App\Form\NoteType;
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
     * @Route("/game/{id}", name="game")
     */
    public function game($id, Request $request)
    {   
        $user = $this->getUser();

        $manager = $this->getDoctrine()->getManager();
        $game = $manager->find(Game::class, $id);

        $repoPlatform = $this->getDoctrine()->getRepository(Platform::class);
        $platform = $repoPlatform->platformGame($id);
        
        $repo = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repo->commentGame($id);

        $repo = $this->getDoctrine()->getRepository(Note::class);
        $noteM = $repo->noteMoyenne($id);

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
            
            return $this->redirectToRoute('game', ['id' => $id]);
        }

        $repository = $this->getDoctrine()->getRepository(Note::class);
        $noteUser = $repository ->findBy(['id_user' => $user, 'id_game' => $id ]);

        if(empty($noteUser) ) {

            $note = new Note;

            if(isset($_POST['submit'])) {

                $notePost = $_POST['submit'];

                $manager = $this -> getDoctrine() -> getManager();
                
                $manager -> persist($note);
                $note -> setNote($notePost);
                $note -> setIdGame($game);
                $note -> setIdUser($user);

                $manager -> flush();
                
                return $this->redirectToRoute('game', ['id' => $id]);

            }
        }

        


        return $this->render('game/game.html.twig', [
            'game' => $game,
            'platform' => $platform,
            'commentForm' => $form -> createView(),
            'comments' => $comments,
            'note' => $noteUser,
            'noteMoyenne' => $noteM
        ]);
    }
}
