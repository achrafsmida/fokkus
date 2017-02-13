<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\ContactUser;
use FKS\CentralBundle\Entity\RequestContact;
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

        $stats = $em->getRepository('FKSCentralBundle:Statistique')->findAll();

        //dump($result);die;

        return $this->render('default/index.html.twig', array(
            'stats' => $stats,
            //  'hotelUnhappy' => $hotelUnhappy,

        ));
    }

    /**
     * Lists all statistique entities.
     *
     * @Route("/request/contact", name="request_contact")
     * @Method("GET")
     */
    public function listAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $requests = $em->getRepository('FKSCentralBundle:ContactUser')->findAll();
        return $this->render('default/requests.html.twig', array(
            'requests' => $requests,
            //  'hotelUnhappy' => $hotelUnhappy,

        ));

    }

    /**
     * Finds and edit status of contact request.
     *
     * @Route("/{id}", name="edit_status")
     * @Method("SET")
     */
    public function editAction(ContactUser $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        if ($request->getStatus() == true) {
            $request->setStatus(false);
        } else {
            $request->setStatus(true);

        }
        $em->persist($request);
        $em->flush($request);

        $requests = $em->getRepository('FKSCentralBundle:ContactUser')->findAll();
        return $this->render('default/requests.html.twig', array(
            'requests' => $requests,
            'request' => $request,

        ));
    }
}
