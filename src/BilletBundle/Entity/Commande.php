<?php
namespace BilletBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\CommandeRepository")
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
     * @ORM\Column(name="list_billet", type="string", length=255)
     */
    private $listBillet;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set listBillet
     *
     * @param string $listBillet
     *
     * @return Commande
     */
    public function setListBillet($listBillet)
    {
        $this->listBillet = $listBillet;
        return $this;
    }
    /**
     * Get listBillet
     *
     * @return string
     */
    public function getListBillet()
    {
        return $this->listBillet;
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
}
