<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\formationcateg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Formationcateg controller.
 *
 */
class formationcategController extends Controller
{
    /**
     * Lists all formationcateg entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formationcategs = $em->getRepository('FokkusV1Bundle:formationcateg')->findAll();

        return $this->render('formationcateg/index.html.twig', array(
            'formationcategs' => $formationcategs,
        ));
    }

    /**
     * Creates a new formationcateg entity.
     *
     */
    public function newAction(Request $request)
    {
        $formationcateg = new Formationcateg();
        $form = $this->createForm('Fokkus\V1Bundle\Form\formationcategType', $formationcateg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formationcateg);
            $em->flush($formationcateg);

            return $this->redirectToRoute('formationcateg_show', array('id' => $formationcateg->getId()));
        }

        return $this->render('formationcateg/new.html.twig', array(
            'formationcateg' => $formationcateg,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formationcateg entity.
     *
     */
    public function showAction(formationcateg $formationcateg)
    {
        $deleteForm = $this->createDeleteForm($formationcateg);

        return $this->render('formationcateg/show.html.twig', array(
            'formationcateg' => $formationcateg,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing formationcateg entity.
     *
     */
    public function editAction(Request $request, formationcateg $formationcateg)
    {
        $deleteForm = $this->createDeleteForm($formationcateg);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\formationcategType', $formationcateg);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formationcateg_edit', array('id' => $formationcateg->getId()));
        }

        return $this->render('formationcateg/edit.html.twig', array(
            'formationcateg' => $formationcateg,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formationcateg entity.
     *
     */
    public function deleteAction(Request $request, formationcateg $formationcateg)
    {
        $form = $this->createDeleteForm($formationcateg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formationcateg);
            $em->flush($formationcateg);
        }

        return $this->redirectToRoute('formationcateg_index');
    }

    /**
     * Creates a form to delete a formationcateg entity.
     *
     * @param formationcateg $formationcateg The formationcateg entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(formationcateg $formationcateg)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formationcateg_delete', array('id' => $formationcateg->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
