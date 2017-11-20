<?php

namespace BilletBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BilletBundle\Entity\Billet;
use BilletBundle\Entity\Commande;
use BilletBundle\Entity\Choix_pays;
use BilletBundle\Entity\type_tarif;
// use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\Extension\Core\Type\FormType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
// use Symfony\Component\Form\Extension\Core\Type\TextType;

class BilletController extends Controller
{

  public function indexAction()
    {
      // ...
      // Notre liste d'annonce en dur
      $listCommandes = array(
          array(
            'id'      => 1,
            'email'  => 'plop@1.fr',
            'date'    => new \Datetime()
          ),
          array(
            'id'      => 2,
            'email'  => 'plop@2.fr',
            'date'    => new \Datetime()
          ),
          array(
            'id'      => 3,
            'email'  => 'plop@3.fr',
            'date'    => new \Datetime(),
          )
      );
      // Et modifiez le 2nd argument pour injecter notre liste
      return $this->render('BilletBundle:Billet:index.html.twig', array(
        'listCommandes' => $listCommandes
      ));


      // $listBillets = array(
      //   array(
      //     'nom'   => 'Plop',
      //     'id'      => 1,
      //     'prenom'  => 'Alexandre',
      //     'date'    => new \Datetime(),
      //     'journee'   => 'true',
      //     'pays'  => 'France',
      //     'type_tarif'  => 'normal'
      //   ),
      //   array(
      //     'nom'   => 'Mission de webmaster',
      //     'id'      => 2,
      //     'prenom'  => 'Hugo',
      //     'date'    => new \Datetime(),
      //     'journee'   => 'true',
      //     'pays'  => 'France',
      //     'type_tarif'  => 'normal'
      //   ),
      //   array(
      //     'nom'   => 'Offre de stage webdesigner',
      //     'id'      => 3,
      //     'prenom'  => 'Mathieu',
      //     'date'    => new \Datetime(),
      //     'journee'   => 'true',
      //     'pays'  => 'France',
      //     'type_tarif'  => 'normal',
      //   )
      // );
      // // Et modifiez le 2nd argument pour injecter notre liste
      // return $this->render('BilletBundle:Billet:index.html.twig', array(
      //   'listBillets' => $listBillets
      // ));
    }

    public function viewAction($id)
    {
      $em = $this->getDoctrine()->getManager();
      // On récupère l'annonce $id
      $commande = $em->getRepository('BilletBundle:Billet')->find($id);
      if (null === $commande) {
        throw new NotFoundHttpException("La commande d'id ".$id." n'existe pas.");
      }
      // On récupère la liste des billets de cette commande
      $listBillets = $em
        ->getRepository('BilletBundle:Billet')
        ->findBy(array('commande' => $commande))
      ;
      return $this->render('BilletBundle:Billet:view.html.twig', array(
        'commande'           => $commande,
        'listBillets' => $listBillets
      ));
    }

  public function addAction(Request $request)
  {
    // Création de l'entité
    $commande = new Commande();
    $commande->setEmail('plop@4.fr');
    // On peut ne pas définir ni la date ni la publication,
    // car ces attributs sont définis automatiquement dans le constructeur
    // On récupère l'EntityManager

    $billet1 = new Billet();
    $billet1->setNom('testNom1');
    $billet1->setPrenom('testPrenom1');
    $billet1->setJournee('1');

    $billet2 = new Billet();
    $billet2->setNom('testNom2');
    $billet2->setPrenom('testPrenom2');
    $billet2->setJournee('1');

    $billet1->setCommande($commande);
    $billet2->setCommande($commande);

    $em = $this->getDoctrine()->getManager();
    // Étape 1 : On « persiste » l'entité
    $em->persist($commande);

    $em->persist($billet1);
    $em->persist($billet2);

    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
    // Reste de la méthode qu'on avait déjà écrit
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Commande bien enregistrée.');
      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('Billet_view', array('id' => $commande->getId()));
    }
    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('BilletBundle:Billet:add.html.twig', array('commande' => $commande));
  }

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $billet = $em->getRepository('BilletBundle:Billet')->find($id);
    if (null === $billet) {
      throw new NotFoundHttpException("Le billet id ".$id." n'existe pas.");
    }
    // La méthode findAll retourne toutes les catégories de la base de données
    $listTarifs = $em->getRepository('BilletBundle:type_tarif')->findAll();
    // On boucle sur les catégories pour les lier à l'annonce
    foreach ($listTarifs as $type_tarif) {
      $billet->addType_tarif($type_tarif);
    }
    // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
    // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine
    // Étape 2 : On déclenche l'enregistrement
    $em->flush();
    // … reste de la méthode
  }

  public function deleteAction($id)
  {
    $em = $this->getDoctrine()->getManager();
    // On récupère l'annonce $id
    $billet = $em->getRepository('BilletBundle:Billet')->find($id);
    if (null === $billet) {
      throw new NotFoundHttpException("Le billet id ".$id." n'existe pas.");
    }
    // On boucle sur les catégories de l'annonce pour les supprimer
    foreach ($billet->getType_tarif() as $type_tarif) {
      $billet->removeType_tarif($type_tarif);
    }
    // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
    // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine
    // On déclenche la modification
    $em->flush();
    // ...
  }
}
