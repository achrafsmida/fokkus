<?php

namespace FKS\CentralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FKSCentralBundle:Default:index.html.twig');
    }

    /**
     * Edit status of request .
     *
     * @Route("/subscription/", name="subscription_show")
     *
     * @param string $id The bookingRequest ID
     * @param string $status The bookingRequest ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function subscriptionAction()
    {
        return $this->render('default/subscription.html.twig');
    }

    /**
     * Edit status of request .
     *
     * @Route("/stats/", name="stats_show")
     *
     * @param string $id The bookingRequest ID
     * @param string $status The bookingRequest ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function statsAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        //dump($sub);die;
       // return new JsonResponse(array('sub' => $sub->getLastName()));

//        $deleteForm = $this->createDeleteForm($network);
//
        return $this->render('default/index.html.twig');
    }
}
