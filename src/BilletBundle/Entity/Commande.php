<?php
namespace BilletBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @Assert\Email()
     * @ORM\Column(name="email", type="string", length=255)
     */
     private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAchat", type="datetime")
     * @Assert\DateTime()
     */
     private $dateAchat;

     /**
     * @var \Date
     *
     * @ORM\Column(name="date_visite", type="date")
     * @Assert\Date()
     */
     private $dateVisite;

    /**
     * @var bool
     *
     * @ORM\Column(name="journee", type="boolean")
     */
     private $journee;

    /**
    * @var boolean
    *
    * @ORM\Column(name="confirmer", type="boolean")
    */
     private $confirmer = true;

     /**
     * @ORM\OneToMany(targetEntity="BilletBundle\Entity\Billet", mappedBy="commande", cascade={"persist"})
     */
     private $billets; // Notez le « s », une commande est liée à plusieurs billets

     /**
     * @ORM\Column(name="nb_billets", type="integer")
     */
     private $nbBillets = 0;

     public function __construct()
     {
       $this->dateAchat = new \Datetime();
       $this->dateVisite = new \Datetime();
       $this->billets = new ArrayCollection();
     }

     public function increaseBillets()
     {
     $this->nbBillets++;
     }

     public function decreaseBillets()
     {
     $this->nbBillets--;
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
      * Set date
      *
      * @param \Date $dateVisite
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
      * @return \Date
      */
     public function getDateVisite()
     {
         return $this->dateVisite;
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

     /**
     * @param bool $confirmer
     */
     public function setConfirmer($confirmer)
     {
       $this->confirmer = $confirmer;
     }

     /**
      * @return bool
      */
     public function getConfirmer()
     {
       return $this->confirmer;
     }

      /**
      * @param Billets $billet
      */
       public function addBillet(Billet $billet)
       {
         $this->billets[] = $billet;
         // On lie la commande au billet
         $billet->setCommande($this);
       }

      /**
      * @param Billet $billet
      */
       public function removeBillet(Billet $billet)
       {
         $this->billets->removeElement($billet);
       }

      /**
      * @return \Doctrine\Common\Collections\Collection
      */
       public function getBillets()
       {
         return $this->billets;
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
     * @param integer $nbBillets
     */
    public function setNbBillets($nbBillets)
    {
        $this->nbBillets = $nbBillets;
    }

    /**
     * @return integer
     */
    public function getNbBillets()
    {
        return $this->nbBillets;
    }

}
