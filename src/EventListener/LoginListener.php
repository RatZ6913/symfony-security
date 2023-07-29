<?php
namespace App\EventListener;

use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LoginListener {

  public function __invoke(LoginSuccessEvent $event) {
    $request = $event->getRequest();
    $userName = $event->getPassport()->getUser()->getName();
    $request->getSession()->getFlashBag()->add('success', 'Bon retour parmis nous' . $userName);
  }
  
}
