<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\evenementcateg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Evenementcateg controller.
 *
 */
class evenementcategController extends Controller
{
    /**
     * Lists all evenementcateg entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenementcategs = $em->getRepository('FokkusV1Bundle:evenementcateg')->findAll();

        return $this->render('evenementcateg/index.html.twig', array(
            'evenementcategs' => $evenementcategs,
        ));
    }

    /**
     * Creates a new evenementcateg entity.
     *
     */
    public function newAction(Request $request)
    {
        $evenementcateg = new Evenementcateg();
        $form = $this->createForm('Fokkus\V1Bundle\Form\evenementcategType', $evenementcateg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenementcateg);
            $em->flush($evenementcateg);

            return $this->redirectToRoute('evenementcateg_show', array('id' => $evenementcateg->getId()));
        }

        return $this->render('evenementcateg/new.html.twig', array(
            'evenementcateg' => $evenementcateg,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenementcateg entity.
     *
     */
    public function showAction(evenementcateg $evenementcateg)
    {
        $deleteForm = $this->createDeleteForm($evenementcateg);

        return $this->render('evenementcateg/show.html.twig', array(
            'evenementcateg' => $evenementcateg,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenementcateg entity.
     *
     */
    public function editAction(Request $request, evenementcateg $evenementcateg)
    {
        $deleteForm = $this->createDeleteForm($evenementcateg);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\evenementcategType', $evenementcateg);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenementcateg_edit', array('id' => $evenementcateg->getId()));
        }

        return $this->render('evenementcateg/edit.html.twig', array(
            'evenementcateg' => $evenementcateg,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenementcateg entity.
     *
     */
    public function deleteAction(Request $request, evenementcateg $evenementcateg)
    {
        $form = $this->createDeleteForm($evenementcateg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenementcateg);
            $em->flush($evenementcateg);
        }

        return $this->redirectToRoute('evenementcateg_index');
    }

    /**
     * Creates a form to delete a evenementcateg entity.
     *
     * @param evenementcateg $evenementcateg The evenementcateg entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(evenementcateg $evenementcateg)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenementcateg_delete', array('id' => $evenementcateg->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
