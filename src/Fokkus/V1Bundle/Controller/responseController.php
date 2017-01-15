<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Response controller.
 *
 */
class responseController extends Controller
{
    /**
     * Lists all response entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $responses = $em->getRepository('FokkusV1Bundle:response')->findAll();

        return $this->render('response/index.html.twig', array(
            'responses' => $responses,
        ));
    }

    /**
     * Creates a new response entity.
     *
     */
    public function newAction(Request $request)
    {
        $response = new Response();
        $form = $this->createForm('Fokkus\V1Bundle\Form\responseType', $response);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($response);
            $em->flush($response);

            return $this->redirectToRoute('response_show', array('id' => $response->getId()));
        }

        return $this->render('response/new.html.twig', array(
            'response' => $response,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a response entity.
     *
     */
    public function showAction(response $response)
    {
        $deleteForm = $this->createDeleteForm($response);

        return $this->render('response/show.html.twig', array(
            'response' => $response,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing response entity.
     *
     */
    public function editAction(Request $request, response $response)
    {
        $deleteForm = $this->createDeleteForm($response);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\responseType', $response);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('response_edit', array('id' => $response->getId()));
        }

        return $this->render('response/edit.html.twig', array(
            'response' => $response,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a response entity.
     *
     */
    public function deleteAction(Request $request, response $response)
    {
        $form = $this->createDeleteForm($response);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($response);
            $em->flush($response);
        }

        return $this->redirectToRoute('response_index');
    }

    /**
     * Creates a form to delete a response entity.
     *
     * @param response $response The response entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(response $response)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('response_delete', array('id' => $response->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
