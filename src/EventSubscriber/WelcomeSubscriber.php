<?php

namespace App\EventSubscriber;

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

    public function onLogout(LogoutEvent $event) 
    {
        // dd($event);
        $this->fs->appendToFile('log.txt', $event->getToken()->getUser()->getEmail() . ' est maintenant déconnecté.' . PHP_EOL);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => ['onLoginSuccessEvent', 150],
            LogoutEvent::class => 'onLogout'
        ];
    }
}

