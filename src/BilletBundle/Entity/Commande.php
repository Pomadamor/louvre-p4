<?php

namespace BilletBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\CommandeRepository")
 */
class commande
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_visite", type="datetime")
     */
    private $dateVisite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_achat", type="Datetime")
     */
    private $dateAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;


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
     * Set dateAchat
     *
     * @param string $dateVisite
     *
     * @return Commande
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get dateVisite
     *
     * @return Datetime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
    }



    /**
     * Set dateAchat
     *
     * @param string $dateAchat
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
     * @return Datetime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
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

    public function getPrixTotal()
    {
      $prix = 0;
      foreach($this->getListeBillets() as $billets) {
        $prix += $billet->getPrix();
      }
      return $prix;
    }

}
