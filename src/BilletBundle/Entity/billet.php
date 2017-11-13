<?php

namespace BilletBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\billetRepository")
 */
class billet
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var bool
     *
     * @ORM\Column(name="journee", type="boolean", nullable=false)
     */
    private $journee;

