<?php 
use Symfony\Contracts\EventDispatcher\Event;

class NewUserEvent extends Event {

  public function __construct(private string $email)
  {
  }

  public function getEmail(): string
  {
    return $this->email;
  }

}