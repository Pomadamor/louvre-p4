<?php
namespace BilletBundle\Email;

use BilletBundle\Entity\Commande;

class CommandeMailer
{
  /**
   * @var \Swift_Mailer
   */
  private $mailer;

  public function __construct(\Swift_Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function sendNewNotification(Commande $commande)
  {
    $message = new \Swift_Message(
      'Nouvelle commande',
      'Vous avez fait un nouvelle commande.'
    );

    $message
      ->addTo($commande->getCommande()->getEmail()) // Ici bien sûr il faudrait un attribut "email", j'utilise "author" à la place
      ->addFrom('admin@votresite.com')
    ;

    $this->mailer->send($message);
  }
}
