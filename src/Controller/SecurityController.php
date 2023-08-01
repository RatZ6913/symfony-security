<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use NewUserEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordHasher, EventDispatcherInterface $eventDispatcher): Response
    {
        $user = new User();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()) {
            // $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            // $em->persist($user);
            // $em->flush();
            // $eventDispatcher->dispatch(new NewUserEvent($user->getEmail()));
            // return $this->redirectToRoute('home');
        }

        return $this->render('security/inscription.html.twig', [
            'controller_name' => 'SecurityController',
            'form' => $userForm->createView()
        ]);
    }

    #[Route('/connexion', name: 'connexion')]
    public function connexion(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // if($error) {
        //     dd($error->getMessageKey());
        // }
    
        return $this->render('security/connexion.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
    }
}



