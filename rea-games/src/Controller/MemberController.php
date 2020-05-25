<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Form\FormError;

use App\Entity\User;

use App\Form\UserType;

class MemberController extends AbstractController
{
    /**
     * @Route("/basket", name="basket")
     */
    public function basket()
    {
        return $this->render('member/basket.html.twig', []);
    }

    /**
     * @Route("/memberArea", name="memberArea")
     */
    public function memberArea()
    {
        return $this->render('member/memberArea.html.twig', []);
    }

    /**
     * @Route("/memberArea/{id}", name="memberAreaGame")
     */
    public function memberAreaGame($id)
    {
        return $this->render('member/memberAreaGame.html.twig', []);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile()
    {
        $user = $this -> getUser();

        return $this->render('member/profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
	* @Route("/login", name="login")
	*/

	public function login(AuthenticationUtils $auth){
		
        $lastUsername = $auth -> getLastUsername();
		$error = $auth -> getLastAuthenticationError();

		if($error){
			$this -> addFlash('errors', 'Le mail et le mot de passe rentrer ne correspondent pas !');
		}

		return $this -> render('member/login.html.twig', [
			'lastUsername' => $lastUsername
		]);
    }
    
    /**
	* @Route("/logout", name="logout")
	*/
	public function logout(){}


	/**
	* @Route("/login_check", name="login_check")
	*/

    public function loginCheck(){}
    
    /**
     * @Route("/register", name="register")
     */
    public function register(UserPasswordEncoderInterface $encoder, Request $request)
    {
        $user = new User;

        $form = $this -> createForm(UserType::class, $user);
        $form -> handleRequest($request);
        
        if ($form -> isSubmitted() && $form -> isValid()) {
            try{
                $manager = $this -> getDoctrine() -> getManager();
			
                $manager -> persist($user);
                $user -> setRole('ROLE_USER');
                $user -> setBalance(0);
                $user -> setAvatar('user.png');
                $user -> setRegisterDate(new \DateTime('now'));
                $password = $user -> getPassword();
                $newPassword = $encoder -> encodePassword($user, $password);
                $user -> setPassword($newPassword);

                $manager -> flush();
                return $this -> redirectToRoute('home');
            }catch(\Doctrine\DBAL\DBALException $e) 
            {
                if( $e->getPrevious()->getCode() === '23000' )
                {
                    $this -> addFlash('errors', 'Un utilisateur utilise déjà cette adresse e-mail !');
                }

                else throw $e;    
            }
        }

        return $this->render('member/register.html.twig', [
            'userForm' => $form -> createView()
        ]);
    }


}
