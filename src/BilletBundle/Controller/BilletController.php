<?php

namespace BilletBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BilletBundle\Entity\billet;
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
        return $this->render('BilletBundle:Billet:home.html.twig');
	//return new Response($content);
    }
    public function addAction()
    {
    // On crée un objet billet et commande
    $billet = new billet();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $billet);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('nom',     TextType::class)
      ->add('prenom',     TextType::class)
      ->add('journee', CheckboxType::class)
      ->add('save',      SubmitType::class)
    ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('BilletBundle:Billet:index.html.twig', array(
      'form' => $form->createView(),
    ));
  }

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
