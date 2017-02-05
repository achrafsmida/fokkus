<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\evenementsubcateg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Evenementsubcateg controller.
 *
 */
class evenementsubcategController extends Controller
{
    /**
     * Lists all evenementsubcateg entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenementsubcategs = $em->getRepository('FokkusV1Bundle:evenementsubcateg')->findAll();

        return $this->render('evenementsubcateg/index.html.twig', array(
            'evenementsubcategs' => $evenementsubcategs,
        ));
    }

    /**
     * Creates a new evenementsubcateg entity.
     *
     */
    public function newAction(Request $request)
    {
        $evenementsubcateg = new Evenementsubcateg();
        $form = $this->createForm('Fokkus\V1Bundle\Form\evenementsubcategType', $evenementsubcateg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenementsubcateg);
            $em->flush($evenementsubcateg);

            return $this->redirectToRoute('evenementsubcateg_show', array('id' => $evenementsubcateg->getId()));
        }

        return $this->render('evenementsubcateg/new.html.twig', array(
            'evenementsubcateg' => $evenementsubcateg,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenementsubcateg entity.
     *
     */
    public function showAction(evenementsubcateg $evenementsubcateg)
    {
        $deleteForm = $this->createDeleteForm($evenementsubcateg);

        return $this->render('evenementsubcateg/show.html.twig', array(
            'evenementsubcateg' => $evenementsubcateg,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenementsubcateg entity.
     *
     */
    public function editAction(Request $request, evenementsubcateg $evenementsubcateg)
    {
        $deleteForm = $this->createDeleteForm($evenementsubcateg);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\evenementsubcategType', $evenementsubcateg);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenementsubcateg_edit', array('id' => $evenementsubcateg->getId()));
        }

        return $this->render('evenementsubcateg/edit.html.twig', array(
            'evenementsubcateg' => $evenementsubcateg,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenementsubcateg entity.
     *
     */
    public function deleteAction(Request $request, evenementsubcateg $evenementsubcateg)
    {
        $form = $this->createDeleteForm($evenementsubcateg);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenementsubcateg);
            $em->flush($evenementsubcateg);
        }

        return $this->redirectToRoute('evenementsubcateg_index');
    }

    /**
     * Creates a form to delete a evenementsubcateg entity.
     *
     * @param evenementsubcateg $evenementsubcateg The evenementsubcateg entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(evenementsubcateg $evenementsubcateg)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenementsubcateg_delete', array('id' => $evenementsubcateg->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
