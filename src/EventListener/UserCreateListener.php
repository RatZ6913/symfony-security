<?php
namespace App\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Filesystem\Filesystem;

class UserCreateListener {

  public function __construct(private Filesystem $fs)
  {
  }

  public function prePersist(LifecycleEventArgs $args)
  {
    // dump('in listenener');
    $this->fs->appendToFile('log.txt', 'About to persist new user' . PHP_EOL);
  }
}