<?php

namespace LOUVRE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\commandeRepository")
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
     * @var \Date
     *
     * @ORM\Column(name="dateVisite", type="date")
     */
    private $dateVisite;

    /**
    * @var int
    *
    * @ORM\Column(name="nombreVisiteur", type="integer")
    */
    private $nombreVisiteur;

    /**
     * @var string
     *
     * @ORM\Column(name="sommeReglee", type="decimal", precision=10, scale=0)
     */
    private $sommeReglee;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

     /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    public $pays;


     /**
     * @var \Date
     *
     * @ORM\Column(name="dateAchat", type="date")
     */
    private $dateAchat;

