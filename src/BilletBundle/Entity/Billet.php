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
     * @var \DateTime
     *
     * @ORM\Column(name="date_visite", type="datetime")
     */
     private $dateVisite;

    /**
     * @var bool
     *
     * @ORM\Column(name="journee", type="boolean")
     */
     private $journee;

    /**
    *
    * @ORM\ManyToOne(targetEntity="BilletBundle\Entity\Commande")
    * @ORM\JoinColumn(referencedColumnName="id")
    */
     private $commande;

     /**
     * @ORM\ManyToMany(targetEntity="BilletBundle\Entity\type_tarif")
     */
     private $type_tarif;

     /**
     * @ORM\ManyToMany(targetEntity="BilletBundle\Entity\Choix_pays")
     */
     private $pays;

     public function __construct()
     {
        $this->dateVisite = new \Datetime();
        $this->type_tarif = new ArrayColletion();
        $this->pays = new ArrayColletion();
     }

      /**
      * @ORM\PrePersist
      */
      public function increase()
      {
        $this->getCommande()->increaseBillet();
      }

      /**
      * @ORM\PreRemove
      */
      public function decrease()
      {
        $this->getCommande()->decreaseBillet();
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
     * Set date
     *
     * @param \DateTime $dateVisite
     *
     * @return Billet
     */
    public function setDateVisite($dateVisite)
    {
        $this->dateVisite = $dateVisite;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDateVisite()
    {
        return $this->dateVisite;
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

    /**
     * Set journee
     *
     * @param boolean $journee
     *
     * @return Billet
     */
    public function setJournee($journee)
    {
        $this->journee = $journee;
        return $this;
    }
    /**
     * Get journee
     *
     * @return bool
     */
    public function getJournee()
    {
        return $this->journee;
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
     public function addType_tarif(Type_tarif $type_tarif)
     {
       // Ici, on utilise l'ArrayCollection vraiment comme un tableau
       $this->type_tarif[] = $type_tarif;
     }

     public function removeType_tarif(Type_tarif $type_tarif)
     {
       // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
       $this->type_tarif->removeElement($type_tarif);
     }
     // Notez le pluriel, on récupère une liste de catégories ici !
     public function getType_tarif()
     {
       return $this->type_tarif;
     }

     // Notez le singulier, on ajoute une seule catégorie à la fois
      public function addPays(Pays $pays)
      {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->pays[] = $pays;
      }

      public function removePays(Pays $pays)
      {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->pays->removeElement($pays);
      }
      // Notez le pluriel, on récupère une liste de catégories ici !
      public function getPays()
      {
        return $this->pays;
      }
}
