<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\groupe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Groupe controller.
 *
 */
class groupeController extends Controller
{
    /**
     * Lists all groupe entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groupes = $em->getRepository('FokkusV1Bundle:groupe')->findAll();

        return $this->render('groupe/index.html.twig', array(
            'groupes' => $groupes,
        ));
    }

    /**
     * Creates a new groupe entity.
     *
     */
    public function newAction(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm('Fokkus\V1Bundle\Form\groupeType', $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush($groupe);

            return $this->redirectToRoute('groupe_show', array('id' => $groupe->getId()));
        }

        return $this->render('groupe/new.html.twig', array(
            'groupe' => $groupe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a groupe entity.
     *
     */
    public function showAction(groupe $groupe)
    {
        $deleteForm = $this->createDeleteForm($groupe);

        return $this->render('groupe/show.html.twig', array(
            'groupe' => $groupe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing groupe entity.
     *
     */
    public function editAction(Request $request, groupe $groupe)
    {
        $deleteForm = $this->createDeleteForm($groupe);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\groupeType', $groupe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('groupe_edit', array('id' => $groupe->getId()));
        }

        return $this->render('groupe/edit.html.twig', array(
            'groupe' => $groupe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a groupe entity.
     *
     */
    public function deleteAction(Request $request, groupe $groupe)
    {
        $form = $this->createDeleteForm($groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush($groupe);
        }

        return $this->redirectToRoute('groupe_index');
    }

    /**
     * Creates a form to delete a groupe entity.
     *
     * @param groupe $groupe The groupe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(groupe $groupe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groupe_delete', array('id' => $groupe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
