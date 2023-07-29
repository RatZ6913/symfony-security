<?php

namespace App\EventSubscriber;

use NewUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class WelcomeSubscriber implements EventSubscriberInterface
{
    public function __construct(private Filesystem $fs) 
    {
    }

    public function onLoginSuccessEvent(LoginSuccessEvent $event): void
    {
        $request = $event->getRequest();
        $request->getSession()->getFlashBag()->add('success', 'Welcome');
    }

    public function onLogoutEvent(LogoutEvent $event) 
    {
        // dd($event);
        $this->fs->appendToFile('log.txt', $event->getToken()->getUser()->getEmail() . ' est maintenant déconnecté.' . PHP_EOL);
    }

    public function onNewUserEvent(NewUserEvent $event)
    {
        $this->fs->appendToFile('log.txt', $event->getEmail() . ' vient de s\'inscrire');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => ['onLoginSuccessEvent', 150],
            LogoutEvent::class => 'onLogoutEvent',
            NewUserEvent::class => 'onNewUserEvent'
        ];
    }
}

