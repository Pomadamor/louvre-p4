<?php

namespace OC\platformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCplatformBundle:Default:index.html.twig');
    }
}
