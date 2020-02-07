<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class SecurityController extends AbstractController implements LogoutSuccessHandlerInterface
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        //return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        //uzycie easyadmin logowania panelu
        return $this->render('@EasyAdmin/page/login.html.twig',
            ['last_username' => $lastUsername,
             'error' => $error,
                'csrf_token_intention'=>'authenticate',
                'username_label'=>'Email',
                'username_parameter'=>'email',
                'password_parameter'=>'password',
            ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    public function onLogoutSuccess(Request $request)
    {
        //dodanie wiadomosci do flash i wyswietlenie w templates/site/index.html.twig

        $this->addFlash('success', 'Wylogowano poprawnie');

        return $this->redirectToRoute("site");
        //return $this->render('site/index.html.twig');
    }


}
