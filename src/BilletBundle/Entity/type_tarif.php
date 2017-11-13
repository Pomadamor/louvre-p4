<?php

namespace BilletBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * typeTarif
 *
 * @ORM\Table(name="type_tarif")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\typeTarifRepository")
 */
class type_tarif
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="somme", type="decimal", precision=10, scale=0)
     */
    private $somme;


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
     * Set type
     *
     * @param string $type
     *
     * @return typeTarif
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set somme
     *
     * @param string $somme
     *
     * @return typeTarif
     */
    public function setSomme($somme)
    {
        $this->somme = $somme;

        return $this;
    }

    /**
     * Get somme
     *
     * @return string
     */
    public function getSomme()
    {
        return $this->somme;
    }
}
