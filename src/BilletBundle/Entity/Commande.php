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
    * @var boolean
    *
    * @ORM\Column(name="confirmer", type="boolean")
    */
     private $confirmer = true;

     /**
      * @ORM\Column(name="updated_at", type="datetime", nullable=true)
      */
     private $updatedAt;

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
       $this->billets = new ArrayCollection();
     }

     /**
     * @ORM\PreUpdate
     */
     public function updateDate()
     {
       $this->setUpdatedAt(new \Datetime());
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

      /**
      * @param \DateTime $updatedAt
      */
       public function setUpdatedAt(\Datetime $updatedAt = null)
       {
           $this->updatedAt = $updatedAt;
       }

      /**
      * @return \DateTime
      */
       public function getUpdatedAt()
       {
           return $this->updatedAt;
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
