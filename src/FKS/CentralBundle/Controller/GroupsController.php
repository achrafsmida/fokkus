<?php

namespace FKS\CentralBundle\Controller;
use Fokkus\V1Bundle\Entity\step;
use Fokkus\V1Bundle\Entity\sousstep;

use FKS\CentralBundle\Entity\Groups;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Group controller.
 *
 */
class GroupsController extends Controller
{
    /**
     * Lists all group entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $groups = $em->getRepository('FKSCentralBundle:Groups')->findAll();
        

        return $this->render('groups/index.html.twig', array(
            'groups' => $groups,
        ));
    }

    /**
     * Creates a new group entity.
     *
     */
    public function newAction(Request $request)
    {
        $group = new Groups();
        $form = $this->createForm('FKS\CentralBundle\Form\GroupsType', $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $group->uploadProfilePicture();
            $em = $this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush($group);
    $this->clonestep($group , $em) ;
           
            
            return $this->redirectToRoute('groups_index', array('id' => $group->getId()));
        }

        return $this->render('groups/new.html.twig', array(
            'group' => $group,
            'form' => $form->createView(),
        ));
    }
public function clonestep($group, $em){
    
    
     $firstgroup = $em->getRepository('FKSCentralBundle:Groups')->find(1) ;
            $steps = $em->getRepository('FokkusV1Bundle:step')->findby(array('groups'=>$firstgroup));
                    foreach($steps as $step){
                        $stepofthisgroup = new step();
                        $stepofthisgroup->setName($step->getName());
                        $stepofthisgroup->setDescription($step->getDescription());
                        $stepofthisgroup->setType($step->getType());
                        $stepofthisgroup->setGroups($group);
                        $em->persist($stepofthisgroup);
                        $em->flush($stepofthisgroup);
                        
                         $subsstep = $em->getRepository('FokkusV1Bundle:sousstep')->findby(array('step'=>$step));
                        foreach($subsstep as $substep){
                                                $substepofthisgroup = new sousstep();
                                                $substepofthisgroup->setName($step->getName());
                                                $substepofthisgroup->setDescription($step->getDescription());
                                                  $substepofthisgroup->setstep($stepofthisgroup);
                                                $em->persist($substepofthisgroup);
                                                $em->flush($substepofthisgroup);
                        }
                        
                        
                    }
    
}
    /**
     * Finds and displays a group entity.
     *
     */
    public function showAction(Groups $group)
    {
        $deleteForm = $this->createDeleteForm($group);

        return $this->render('groups/show.html.twig', array(
            'group' => $group,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing group entity.
     *
     */
    public function editAction(Request $request, Groups $group)
    {
        $deleteForm = $this->createDeleteForm($group);
        $editForm = $this->createForm('FKS\CentralBundle\Form\GroupsType', $group);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('groups_edit', array('id' => $group->getId()));
        }

        return $this->render('groups/edit.html.twig', array(
            'group' => $group,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a group entity.
     *
     */
    public function deleteAction(Request $request, Groups $group)
    {
        $form = $this->createDeleteForm($group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($group);
            $em->flush($group);
        }

        return $this->redirectToRoute('groups_index');
    }

    /**
     * Creates a form to delete a group entity.
     *
     * @param Groups $group The group entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Groups $group)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('groups_delete', array('id' => $group->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
