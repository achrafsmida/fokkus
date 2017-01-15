<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\subNetwork;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Subnetwork controller.
 *
 */
class subNetworkController extends Controller
{
    /**
     * Lists all subNetwork entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subNetworks = $em->getRepository('FKSCentralBundle:subNetwork')->findAll();

        return $this->render('subnetwork/index.html.twig', array(
            'subNetworks' => $subNetworks,
        ));
    }

    /**
     * Creates a new subNetwork entity.
     *
     */
    public function newAction(Request $request)
    {
        $subNetwork = new Subnetwork();
        $form = $this->createForm('FKS\CentralBundle\Form\subNetworkType', $subNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subNetwork);
            $em->flush($subNetwork);

            return $this->redirectToRoute('subnetwork_show', array('id' => $subNetwork->getId()));
        }

        return $this->render('subnetwork/new.html.twig', array(
            'subNetwork' => $subNetwork,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subNetwork entity.
     *
     */
    public function showAction(subNetwork $subNetwork)
    {
        $deleteForm = $this->createDeleteForm($subNetwork);

        return $this->render('subnetwork/show.html.twig', array(
            'subNetwork' => $subNetwork,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subNetwork entity.
     *
     */
    public function editAction(Request $request, subNetwork $subNetwork)
    {
        $deleteForm = $this->createDeleteForm($subNetwork);
        $editForm = $this->createForm('FKS\CentralBundle\Form\subNetworkType', $subNetwork);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subnetwork_edit', array('id' => $subNetwork->getId()));
        }

        return $this->render('subnetwork/edit.html.twig', array(
            'subNetwork' => $subNetwork,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subNetwork entity.
     *
     */
    public function deleteAction(Request $request, subNetwork $subNetwork)
    {
        $form = $this->createDeleteForm($subNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subNetwork);
            $em->flush($subNetwork);
        }

        return $this->redirectToRoute('subnetwork_index');
    }

    /**
     * Creates a form to delete a subNetwork entity.
     *
     * @param subNetwork $subNetwork The subNetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(subNetwork $subNetwork)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subnetwork_delete', array('id' => $subNetwork->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
