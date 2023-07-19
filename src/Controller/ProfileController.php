<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(): Response
    {

        // $user = $this->getUser();
        // dump($user);

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            // 'user' => $user
        ]);
    }
}

