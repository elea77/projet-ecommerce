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
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Knp\Component\Pager\PaginatorInterface;


class GameController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(PaginatorInterface $paginator, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Game::class);
        $donnees = $repository -> findAll();

        $games = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            8 // Nombre de résultats par page
        );
        

        return $this->render('game/home.html.twig', [
            'games' => $games
        ]);
    }



    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request)
    {
        
        $search = $_POST['search'];

        $repository = $this->getDoctrine()->getRepository(Game::class);
        $results = $repository -> resultsSearch($search);
    

        return $this->render('game/resultsSearch.html.twig', [
            'results' => $results,
            'search' => $search
        ]);
    }


    /**
     * @Route("/game/{id}", name="game")
     */
    public function game($id, Request $request, PaginatorInterface $paginator)
    {   
        $user = $this->getUser();

        $manager = $this->getDoctrine()->getManager();
        $game = $manager->find(Game::class, $id);

        $repoPlatform = $this->getDoctrine()->getRepository(Platform::class);
        $platform = $repoPlatform->platformGame($id);
        
        $repo = $this->getDoctrine()->getRepository(Comment::class);
        $donnees = $repo->commentGame($id);

        $comments = $paginator->paginate(
            $donnees, 
            $request->query->getInt('page', 1),
            4 // Nombre de résultats par page
        );

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

        if(isset($_POST['submit'])) {

            if(empty($noteUser) ) {

                $note = new Note;

                $notePost = $_POST['submit'];

                $manager = $this -> getDoctrine() -> getManager();
                
                $manager -> persist($note);
                $note -> setNote($notePost);
                $note -> setIdGame($game);
                $note -> setIdUser($user);

                $manager -> flush();
                
                return $this->redirectToRoute('game', ['id' => $id]);

            }else{
                $manager = $this -> getDoctrine() -> getManager();
                $notePost = $_POST['submit'];

                $manager -> persist($noteUser[0]);
                $noteUser[0] -> setNote($notePost);
                $manager ->  flush();   
                
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

    /**
     * @Route("/game/deleteComment/{id_comment}/{id_game}", name="deleteComment")
     */
    public function deleteComment($id_comment,$id_game){
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id_comment);
        $manager = $this -> getDoctrine() -> getManager();
        $manager->remove($comment);
        $manager->flush();

        return $this->redirectToRoute('game', ['id' => $id_game]);
    }

    /**
     * @Route("/game/modifyComment/{id_comment}/{id_game}", name="modifyComment")
     */
    public function modifyComment($id_comment,$id_game,Request $request){
        $comment = $this->getDoctrine()->getRepository(Comment::class)->find($id_comment);
        $manager = $this -> getDoctrine() -> getManager();
        $manager -> persist($comment);
        $newComment = $_POST['newComment'];
        if($newComment == ''){
            return $this->redirectToRoute('deleteComment', ['id_comment' => $id_comment, 'id_game' => $id_game]);
        }else{
            $comment->setReview($newComment);
            $manager->flush();
        }
        return $this->redirectToRoute('game', ['id' => $id_game]);
    }
}
