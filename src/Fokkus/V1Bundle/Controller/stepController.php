<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\step;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Step controller.
 *
 */
class stepController extends Controller
{
    /**
     * Lists all step entities.
     *
     */
    public function stepsgroupsAction($type){
        
          $em = $this->getDoctrine()->getManager();
        $session = new Session();
        $session->set('type', $type);
        
        if($type == 1) $session->set('typestring', "Commerciale");
        if($type == 2)$session->set('typestring', "Communication");
        if($type == 3)$session->set('typestring', "Résaux humaines");
        if($type == 4)$session->set('typestring', "Technique");
        $groups = $em->getRepository('FKSCentralBundle:Groups')->findAll();
        

        return $this->render('step/groups.html.twig', array(
            'groups' => $groups,
        ));
        
    }
    public function indexAction($type , $group)
    {
        $em = $this->getDoctrine()->getManager();

        $session = new Session();
        $session->set('type', $type);
        
        if($type == 1) $session->set('typestring', "Commerciale");
        if($type == 2)$session->set('typestring', "Communication");
        if($type == 3)$session->set('typestring', "Résaux humaines");
        if($type == 4)$session->set('typestring', "Technique");
        
        $group = $em->getRepository('FokkusV1Bundle:step')->find($group);
        $steps = $em->getRepository('FokkusV1Bundle:step')->findBy(array('type'=>$type , 'groups'=>$group));

        return $this->render('step/index.html.twig', array(
            'steps' => $steps,$type => $type
        ));
    }
    public function step_visualtionAction(){
        $em = $this->getDoctrine()->getManager();

        $session = new Session();
        $type= $session->get('type');
        $steps = $em->getRepository('FokkusV1Bundle:step')->findByType($type);
        return $this->render('step/visualion.html.twig', array(
            'steps' => $steps,$type => $type
        ));
        
    }
    /**
     * Creates a new step entity.
     *
     */
    public function newAction(Request $request)
    {
        $step = new Step();
        $form = $this->createForm('Fokkus\V1Bundle\Form\stepType', $step);
        $form->handleRequest($request);
            $session = new Session();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $step->setType($session->get('type'))  ;
            $em->persist($step);
            $em->flush($step);

            return $this->redirectToRoute('step_show', array('id' => $step->getId()));
        }

        return $this->render('step/new.html.twig', array(
            'step' => $step,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a step entity.
     *
     */
    public function showAction(step $step)
    {
        $deleteForm = $this->createDeleteForm($step);

        return $this->render('step/show.html.twig', array(
            'step' => $step,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing step entity.
     *
     */
    public function editAction(Request $request, step $step)
    {
        $deleteForm = $this->createDeleteForm($step);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\stepType', $step);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('step_edit', array('id' => $step->getId()));
        }

        return $this->render('step/edit.html.twig', array(
            'step' => $step,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a step entity.
     *
     */
    public function deleteAction(Request $request, step $step)
    {
        $form = $this->createDeleteForm($step);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($step);
            $em->flush($step);
        }

        return $this->redirectToRoute('step_index');
    }

    /**
     * Creates a form to delete a step entity.
     *
     * @param step $step The step entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(step $step)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('step_delete', array('id' => $step->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
