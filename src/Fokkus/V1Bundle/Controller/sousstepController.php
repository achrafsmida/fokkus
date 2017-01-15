<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\sousstep;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Sousstep controller.
 *
 */
class sousstepController extends Controller
{
    /**
     * Lists all sousstep entities.
     *
     */
    public function indexAction($step)
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $session->set('step', $step);
                            $step = $em->getRepository('FokkusV1Bundle:step')->find($step );

        $soussteps = $em->getRepository('FokkusV1Bundle:sousstep')->findByStep($step);

        return $this->render('sousstep/index.html.twig', array(
            'soussteps' => $soussteps,
        ));
    }
public function sousstepvisualitationAction($step)
    {
        $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $session->set('step', $step);
              $step = $em->getRepository('FokkusV1Bundle:step')->find($step );

        $soussteps = $em->getRepository('FokkusV1Bundle:sousstep')->findByStep($step);

        return $this->render('sousstep/visualitation.html.twig', array(
            'soussteps' => $soussteps,
        ));
    }
    /**
     * Creates a new sousstep entity.
     *
     */
    public function newAction(Request $request)
    {
        $sousstep = new Sousstep();
        $form = $this->createForm('Fokkus\V1Bundle\Form\sousstepType', $sousstep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $session = new Session();
       $step =  $session->get('step');
                    $step = $em->getRepository('FokkusV1Bundle:step')->find($step );
            $sousstep->setStep($step);
            $em->persist($sousstep);
            $em->flush($sousstep);

            return $this->redirectToRoute('sousstep_index', array('step' =>$session->get('step')));
        }

        return $this->render('sousstep/new.html.twig', array(
            'sousstep' => $sousstep,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousstep entity.
     *
     */
    public function showAction(sousstep $sousstep)
    {
        $deleteForm = $this->createDeleteForm($sousstep);

        return $this->render('sousstep/show.html.twig', array(
            'sousstep' => $sousstep,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sousstep entity.
     *
     */
    public function editAction(Request $request, sousstep $sousstep)
    {
        $deleteForm = $this->createDeleteForm($sousstep);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\sousstepType', $sousstep);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sousstep_edit', array('id' => $sousstep->getId()));
        }

        return $this->render('sousstep/edit.html.twig', array(
            'sousstep' => $sousstep,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sousstep entity.
     *
     */
    public function deleteAction(Request $request, sousstep $sousstep)
    {
        $form = $this->createDeleteForm($sousstep);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousstep);
            $em->flush($sousstep);
        }

        return $this->redirectToRoute('sousstep_index');
    }

    /**
     * Creates a form to delete a sousstep entity.
     *
     * @param sousstep $sousstep The sousstep entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(sousstep $sousstep)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sousstep_delete', array('id' => $sousstep->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
