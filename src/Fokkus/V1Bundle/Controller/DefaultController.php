<?php

namespace Fokkus\V1Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FokkusV1Bundle:Default:index.html.twig');
    }
}
