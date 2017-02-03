<?php

namespace Fokkus\V1Bundle\Controller;

use Fokkus\V1Bundle\Entity\formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Formation controller.
 *
 */
class formationController extends Controller
{
    /**
     * Lists all formation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formations = $em->getRepository('FokkusV1Bundle:formation')->findAll();

        return $this->render('formation/index.html.twig', array(
            'formations' => $formations,
        ));
    }

    public function visualitationformationAction()
        {
         $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('FokkusV1Bundle:formationcateg')->findAll();
        $formations = array() ;
         foreach($categories as $categ)
             {
             array_push($formations  , 
                  array(
                  'categ'=>$categ , 
                 'formations'=>$em->getRepository('FokkusV1Bundle:formation')->findByFormationcateg($categ)
                     )
                     );
             
         }
        
         
         return $this->render('formation/visualitation.html.twig', array(
            'formations' => $formations,
        ));
         
        }
    
    
    
    /**
     * Creates a new formation entity.
     *
     */
    public function newAction(Request $request)
    {
        $formation = new Formation();
        $form = $this->createForm('Fokkus\V1Bundle\Form\formationType', $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush($formation);

            return $this->redirectToRoute('formation_show', array('id' => $formation->getId()));
        }

        return $this->render('formation/new.html.twig', array(
            'formation' => $formation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formation entity.
     *
     */
    public function showAction(formation $formation)
    {
        $deleteForm = $this->createDeleteForm($formation);

        return $this->render('formation/show.html.twig', array(
            'formation' => $formation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing formation entity.
     *
     */
    public function editAction(Request $request, formation $formation)
    {
        $deleteForm = $this->createDeleteForm($formation);
        $editForm = $this->createForm('Fokkus\V1Bundle\Form\formationType', $formation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation_edit', array('id' => $formation->getId()));
        }

        return $this->render('formation/edit.html.twig', array(
            'formation' => $formation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formation entity.
     *
     */
    public function deleteAction(Request $request, formation $formation)
    {
        $form = $this->createDeleteForm($formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formation);
            $em->flush($formation);
        }

        return $this->redirectToRoute('formation_index');
    }

    /**
     * Creates a form to delete a formation entity.
     *
     * @param formation $formation The formation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(formation $formation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formation_delete', array('id' => $formation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
