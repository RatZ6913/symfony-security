<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class DbSubscriber implements EventSubscriberInterface
{
    public function prePersist(LifecycleEventArgs $event)
    {
        // dump($event);
        // dd('in subscriber');
        $object = $event->getObject();
        if ($object instanceof User) {
            $object->setName('Clown');
        }
    }
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist
        ];
    }
}
