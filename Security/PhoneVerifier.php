<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class PhoneVerifier
{
    private $entityManager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }

    public function sendPhoneConfirmation(string $verifyPhoneRouteName, UserInterface $user): void
    {
        //
    }

    //cf emailverifier
}
