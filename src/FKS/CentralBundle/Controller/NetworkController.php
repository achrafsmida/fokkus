<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\Network;
use FKS\CentralBundle\Entity\subNetwork;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Network controller.
 *
 */
class NetworkController extends Controller
{
    /**
     * Lists all network entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $networks = $em->getRepository('FKSCentralBundle:Network')->findAll();

        return $this->render('network/index.html.twig', array(
            'networks' => $networks,
        ));
    }

    /**
     * Creates a new network entity.
     *
     */
    public function newAction(Request $request)
    {
        $network = new Network();

        /** @var User $user */
        $user = $this->getUser();
        $sub = false;
        // Check if user is manager
        if ($user->hasRole('ROLE_GROUP')) {
            $sub = true;
        } else {
            $sub = false;
        }

        $form = $this->createForm('FKS\CentralBundle\Form\NetworkType', $network, array('sub' => $sub));
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $subNetwork = $em->getRepository('FKSCentralBundle:subNetwork')->findOneByUser($user);
        $group = $subNetwork->getNetwork()->getGroup();
        if ($form->isSubmitted() && $form->isValid()) {

            if ($sub == true ){
              $network->setGroup($group)  ;
            }
            $em->persist($network);
            $em->flush($network);

            return $this->redirectToRoute('network_show', array('id' => $network->getId()));
        }

        return $this->render('network/new.html.twig', array(
            'network' => $network,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a network entity.
     *
     */
    public function showAction(Network $network)
    {
        $deleteForm = $this->createDeleteForm($network);

        return $this->render('network/show.html.twig', array(
            'network' => $network,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing network entity.
     *
     */
    public function editAction(Request $request, Network $network)
    {
        $deleteForm = $this->createDeleteForm($network);
        $user = $this->getUser();
        // Check if user is manager
        if ($user->hasRole('ROLE_GROUP')) {
            $sub = true;
        } else {
            $sub = false;
        }

        $editForm = $this->createForm('FKS\CentralBundle\Form\NetworkType', $network, array('sub' => $sub));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subNetwork = $em->getRepository('FKSCentralBundle:subNetwork')->findOneByUser($user);
            $group = $subNetwork->getNetwork()->getGroup();
                if ($sub == true ){
                    $network->setGroup($group)  ;}
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('network_edit', array('id' => $network->getId()));
        }

        return $this->render('network/edit.html.twig', array(
            'network' => $network,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a network entity.
     *
     */
    public function deleteAction(Request $request, Network $network)
    {
        $form = $this->createDeleteForm($network);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($network);
            $em->flush($network);
        }

        return $this->redirectToRoute('network_index');
    }

    /**
     * Creates a form to delete a network entity.
     *
     * @param Network $network The network entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Network $network)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('network_delete', array('id' => $network->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/display/", name="sub_show")
     *
     * @param string $id The bookingRequest ID
     * @param string $status The bookingRequest ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function showSubAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $id = $request->get('id');
        $query = $em->createQuery(
            'SELECT sub FROM FKSCentralBundle:subNetwork sub    WHERE   sub.id = :id  ')
            ->setParameter("id", $id);
        //dump($sub);die;
        return new JsonResponse($query->getArrayResult()[0]);

//        $deleteForm = $this->createDeleteForm($network);
//
//        return $this->render('network/show.html.twig', array(
//            'network' => $network,
//            'delete_form' => $deleteForm->createView(),
//        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/network/list/", name="list")
     *
     * @param string $id The bookingRequest ID
     * @param string $status The bookingRequest ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $networks = $em->getRepository('FKSCentralBundle:Network')->findAll();

        return $this->render('network/list.html.twig', array(
            'networks' => $networks,
        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/delete-network/", name="deleted_network")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function delAction(Network $network)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($network);
        $em->flush($network);

        return $this->redirectToRoute('list');
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/find/", name="find_network")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function findAction(Request $request, Network $network)
    {

        $em = $this->getDoctrine()->getManager();
        if ($network->getHaveUser() == true) {
            $response = true;
        } else {
            $response = false;
        }

        return new JsonResponse(array('response' => $response));
    }
}
