<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserFormSubscriber implements EventSubscriberInterface
{

  public function onPreSetDataEvent(FormEvent $event)
  {
    $data = $event->getData();
    $form = $event->getForm();
    if ($data->getName() === 'Jean') {
      $form->add('gender');
    }
  }

  public function onPostSetDataEvent(FormEvent $event)
  {
    $data = $event->getData();
    $form = $event->getForm();
    if ($data->getName() === 'Jean') {
      $form->get('gender')->setData('homme');
    }
  }

  public function onPreSubmitDataEvent(FormEvent $event)
  {
    $data = $event->getData();
    if ($data['name']) {
      $data['email'] = $data['name'] . '@gmail.com';
    }
    $event->setData($data);
  }

  public static function getSubscribedEvents()
  {
    return [
      FormEvents::PRE_SET_DATA => 'onPreSetDataEvent',
      FormEvents::POST_SET_DATA => 'onPostSetDataEvent',
      FormEvents::PRE_SUBMIT => 'onPreSubmitDataEvent',
    ];
  }
}