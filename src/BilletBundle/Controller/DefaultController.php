<?php

namespace BilletBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BilletBundle:Default:index.html.twig');
    }
}
