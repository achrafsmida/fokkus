<?php

namespace FKS\CentralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FKSCentralBundle:Default:index.html.twig');
    }
}
