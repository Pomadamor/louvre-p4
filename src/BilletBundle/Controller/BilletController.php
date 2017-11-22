<?php

namespace BilletBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BilletBundle\Entity\Billet;
use BilletBundle\Entity\Commande;
use BilletBundle\Entity\Choix_pays;
use BilletBundle\Entity\type_tarif;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BilletController extends Controller
{

  public function indexAction()
    {
      // Pour récupérer la liste de toutes les commandes : on utilise findAll()
       $listCommandes = $this->getDoctrine()
         ->getManager()
         ->getRepository('BilletBundle:Commande')
         ->getCommandes()
       ;

       return $this->render('BilletBundle:Billet:index.html.twig', array(
         'listCommandes' => $listCommandes,
       ));
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
      // On crée un objet Advert
      $commande = new Commande();

      // On crée le FormBuilder grâce au service form factory
      $form = $this->get('form.factory')->createBuilder(FormType::class, $commande)
        ->add('email',     TextType::class)
        ->add('confirmer', CheckboxType::class)
        ->add('save',      SubmitType::class)
        ->getForm()
      ;
      if ($request->isMethod('POST')) {
        $form->handleRequest($request);
        if ($form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($commande);
          $em->flush();
          $request->getSession()->getFlashBag()->add('notice', 'Commande bien enregistrée.');
          return $this->redirectToRoute('Billet_view', array('id' => $commande->getId()));
        }
      }
      return $this->render('BilletBundle:Billet:add.html.twig', array(
        'form' => $form->createView(),
      ));
     }

     public function editAction($id, Request $request)
     {
       $em = $this->getDoctrine()->getManager();
       $commande = $em->getRepository('BilletBundle:Billet')->find($id);
       if (null === $commande) {
         throw new NotFoundHttpException("La commande d'id ".$id." n'existe pas.");
       }
       // Ici encore, il faudra mettre la gestion du formulaire
       if ($request->isMethod('POST')) {
         $request->getSession()->getFlashBag()->add('notice', 'La commande bien modifiée.');
         return $this->redirectToRoute('billet_view', array('id' => $commande->getId()));
       }
       return $this->render('BilletBundle:Billet:edit.html.twig', array(
         'commande' => $commande
       ));
     }

      public function deleteAction($id)
      {
        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $billet = $em->getRepository('BilletBundle:Billet')->find($id);
        if (null === $billet) {
          throw new NotFoundHttpException("La commande id ".$id." n'existe pas.");
        }
        // On boucle sur les catégories de l'annonce pour les supprimer
        foreach ($commande->getBillet() as $billet) {
          $commande->removeBillet($billet);
        }
        $em->flush();
        return $this->render('BilletBundle:Billet:delete.html.twig');
      }
}
