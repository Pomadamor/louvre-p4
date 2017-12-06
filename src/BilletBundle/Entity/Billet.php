<?php
namespace BilletBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="BilletBundle\Repository\BilletRepository")
 */
class Billet
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
    * @var \Date
    *
    * @ORM\Column(name="date_visite", type="date")
    */
    private $dateNaissance;

    /**
    * @var string
    *
    * @ORM\Column(name="pays", type="string", length=255)
    */
    private $pays;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduit", type="boolean")
     */
     private $reduit;


    /**
    *
    * @ORM\ManyToOne(targetEntity="BilletBundle\Entity\Commande")
    * @ORM\JoinColumn(referencedColumnName="id", nullable = false)
    */
     private $commande;

      // /**
      // * @ORM\PrePersist
      // */
      // public function increase()
      // {
      //   $this->getCommande()->increaseBillet();
      // }
      //
      // /**
      // * @ORM\PreRemove
      // */
      // public function decrease()
      // {
      //   $this->getCommande()->decreaseBillet();
      // }


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Billet
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Billet
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Billet
     */
    public function setpays($pays)
    {
        $this->pays = $pays;
        return $this;
    }
    /**
     * Get pays
     *
     * @return string
     */
    public function getpays()
    {
        return $this->pays;
    }

    /**
     * Set date
     *
     * @param \Date $dateNaissance
     *
     * @return Billet
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get date
     *
     * @return \Date
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

   /**
    * Set reduit
    *
    * @param boolean $reduit
    *
    * @return Billet
    */
   public function setReduit($reduit)
   {
       $this->reduit = $reduit;
       return $this;
   }
   /**
    * Get reduit
    *
    * @return bool
    */
   public function getReduit()
   {
       return $this->reduit;
   }

    /**
     * @param Commande $commande
     */
    public function setCommande(Commande $commande)
    {
      $this->commande = $commande;
    }

    /**
     * @return Commande
     */
    public function getCommande()
    {
      return $this->commande;
    }

}
