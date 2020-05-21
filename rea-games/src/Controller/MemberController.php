<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/signUp", name="signUp")
     */
    public function signUp()
    {
        return $this->render('member/signUp.html.twig', []);
    }


}
