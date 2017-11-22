<?php
namespace BilletBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\CommandeRepository")
* @ORM\HasLifecycleCallbacks()
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
     private $email;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAchat", type="datetime")
     */
     private $dateAchat;

     /**
      * @ORM\Column(name="updated_at", type="datetime", nullable=true)
      */
     private $updatedAt;

     public function __construct()
     {
       $this->dateAchat = new \Datetime();
     }

     /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     *
     * @return Commande
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;
        return $this;
    }
    /**
     * Get dateAchat
     *
     * @return \DateTime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }
    public function getPrixTotal()
    {
      $prix = 0;
      foreach($this->getListeBillets() as $billets) {
        $prix += $billet->getPrix();
      }
      return $prix;

    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
      $this->setUpdatedAt(new \Datetime());
    }

}
