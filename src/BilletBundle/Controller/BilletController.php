<?php

namespace BilletBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BilletBundle\Entity\Billet;
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
      $listBillets = array(
        array(
          'nom'   => 'Plop',
          'id'      => 1,
          'prenom'  => 'Alexandre',
          'date'    => new \Datetime(),
          'journee'   => 'true',
          'pays'  => 'France',
          'type_tarif'  => 'normal'
        ),
        array(
          'nom'   => 'Mission de webmaster',
          'id'      => 2,
          'prenom'  => 'Hugo',
          'date'    => new \Datetime(),
          'journee'   => 'true',
          'pays'  => 'France',
          'type_tarif'  => 'normal'
        ),
        array(
          'nom'   => 'Offre de stage webdesigner',
          'id'      => 3,
          'prenom'  => 'Mathieu',
          'date'    => new \Datetime(),
          'journee'   => 'true',
          'pays'  => 'France',
          'type_tarif'  => 'normal',
        )
      );
      // Et modifiez le 2nd argument pour injecter notre liste
      return $this->render('BilletBundle:Billet:index.html.twig', array(
        'listBillets' => $listBillets
      ));
    }

  public function viewAction($id)
  {
    $billet = array(
      'title'   => 'Recherche développpeur Symfony2',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );
    return $this->render('BilletBundle:Billet:view.html.twig', array(
      'billet' => $billet
    ));

  }

  public function addAction(Request $request)
  {
    // Création de l'entité
    $billet = new Billet();
    $billet->setNom('Lerna');
    $billet->setPrenom('Ines');
    $billet->setJournee('1');
    // On peut ne pas définir ni la date ni la publication,
    // car ces attributs sont définis automatiquement dans le constructeur
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();
    // Étape 1 : On « persiste » l'entité
    $em->persist($billet);
    // Étape 2 : On « flush » tout ce qui a été persisté avant
    $em->flush();
    // Reste de la méthode qu'on avait déjà écrit
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Billet bien enregistrée.');
      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('Billet_view', array('id' => $billet->getId()));
    }
    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('BilletBundle:Billet:add.html.twig', array('billet' => $billet));
  }

  public function editAction($id, Request $request)
  {
    // Ici, on récupérera l'annonce correspondante à $id
    // Même mécanisme que pour l'ajout
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
      return $this->redirectToRoute('Billet_view', array('id' => 5));
    }
    return $this->render('BilletBundle:Billet:edit.html.twig');
  }

  public function deleteAction($id)
  {
    // Ici, on récupérera l'annonce correspondant à $id
    // Ici, on gérera la suppression de l'annonce en question
    return $this->render('BilletBundle:Billet:delete.html.twig');
  }

  //   public function addAction()
  //   {
  //   // On crée un objet billet et commande
  //   $billet = new billet();
  //
  //   // On crée le FormBuilder grâce au service form factory
  //   $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $billet);
  //
  //   // On ajoute les champs de l'entité que l'on veut à notre formulaire
  //   $formBuilder
  //     ->add('nom',     TextType::class)
  //     ->add('prenom',     TextType::class)
  //     ->add('journee', CheckboxType::class)
  //     ->add('save',      SubmitType::class)
  //   ;
  //   // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard
  //
  //   // À partir du formBuilder, on génère le formulaire
  //   $form = $formBuilder->getForm();
  //
  //   // On passe la méthode createView() du formulaire à la vue
  //   // afin qu'elle puisse afficher le formulaire toute seule
  //   return $this->render('BilletBundle:Billet:index.html.twig', array(
  //     'form' => $form->createView(),
  //   ));
  // }

  //   public function addCommandeAction()
  //   {
  //   // On crée un objet billet et commande
  //   $commande = new commande();
  //
  //   // On crée le FormBuilder grâce au service form factory
  //   $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $commande);
  //
  //   // On ajoute les champs de l'entité que l'on veut à notre formulaire
  //   $formBuilder
  //     ->add('save',      SubmitType::class)
  //   ;
  //   // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard
  //
  //   // À partir du formBuilder, on génère le formulaire
  //   $form = $formBuilder->getForm();
  //
  //   // On passe la méthode createView() du formulaire à la vue
  //   // afin qu'elle puisse afficher le formulaire toute seule
  //   return $this->render('BilletBundle:Billet:add.html.twig', array(
  //     'form' => $form->createView(),
  //   ));
  // }


}
