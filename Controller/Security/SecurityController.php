<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    protected $authenticationUtils;
    protected $requestStack;

    public function __construct(AuthenticationUtils $authenticationUtils, RequestStack $requestStack)
    {
        $this->authUtils = $authenticationUtils;
        $this->requestStack = $requestStack;
    }
    /**
     *  @Route("/connexion", name="security_connexion", methods={"POST"}, priority=1)
     */
    public function login()
    {
        $this->requestStack->getSession()->get('lastUrl', '');

        // get the login error if there is one
        $error = $this->authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $this->authUtils->getLastUsername();

        $user = new User;
        $form = $this->createForm(LoginType::class, $user, [
            'action' => $this->generateUrl('security_connexion')]);
        return [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error'         => $error];
    }    
}
