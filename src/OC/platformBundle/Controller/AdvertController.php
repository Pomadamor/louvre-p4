<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller
{
  // La route fait appel à OCPlatformBundle:Advert:view,
  // on doit donc définir la méthode viewAction.
  // On donne à cette méthode l'argument $id, pour
  // correspondre au paramètre {id} de la route
     public function viewAction($id)
     {
    // $id vaut 5 si l'on a appelé l'URL /platform/advert/5

    // Ici, on récupèrera depuis la base de données
    // l'annonce correspondant à l'id $id.
    // Puis on passera l'annonce à la vue pour
    // qu'elle puisse l'afficher

      return new Response("Affichage de l'annonce d'id : ".$id);
     }
     public function indexAction()
     {
        $content = $this->render('OCplatformBundle:Advert:index.html.twig', array('nom' => 'Cheri'));
        return new Response($content);
     }
}
