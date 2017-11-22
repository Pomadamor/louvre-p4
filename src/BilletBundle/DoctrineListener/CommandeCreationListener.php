<?php

namespace BilletBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use BilletBundle\Email\CommandeMailer;
use BilletBundle\Entity\Commande;

class CommandeCreationListener
{
  /**
   * @var ApplicationMailer
   */
  private $commandeMailer;

  public function __construct(CommandeMailer $commandeMailer)
  {
    $this->commandeMailer = $commandeMailer;
  }

  public function postPersist(LifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    // On ne veut envoyer un email que pour les entités Commande
    if (!$entity instanceof Commande) {
      return;
    }
    $this->commandeMailer->sendNewNotification($entity);
  }
}
