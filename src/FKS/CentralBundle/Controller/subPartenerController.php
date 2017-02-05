<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\subPartener;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\OptionsResolver\Exception\AccessException;

/**
 * Subpartener controller.
 *
 */
class subPartenerController extends Controller
{
    /**
     * Lists all subPartener entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subParteners = $em->getRepository('FKSCentralBundle:subPartener')->findAll();

        return $this->render('subpartener/index.html.twig', array(
            'subParteners' => $subParteners,
        ));
    }

    /**
     * Creates a new subPartener entity.
     *
     */
    public function newAction(Request $request)
    {
        $subPartener = new Subpartener();
        $form = $this->createForm('FKS\CentralBundle\Form\subPartenerType', $subPartener);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subPartener->uploadProfilePicture();
            $em->persist($subPartener);
            $em->flush($subPartener);

            return $this->redirectToRoute('subpartener_show', array('id' => $subPartener->getId()));
        }

        return $this->render('subpartener/new.html.twig', array(
            'subPartener' => $subPartener,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subPartener entity.
     *
     */
    public function showAction(subPartener $subPartener)
    {
        $deleteForm = $this->createDeleteForm($subPartener);

        return $this->render('subpartener/show.html.twig', array(
            'subPartener' => $subPartener,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subPartener entity.
     *
     */
    public function editAction(Request $request, subPartener $subPartener)
    {
        $deleteForm = $this->createDeleteForm($subPartener);
        $editForm = $this->createForm('FKS\CentralBundle\Form\subPartenerType', $subPartener);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subpartener_edit', array('id' => $subPartener->getId()));
        }

        return $this->render('subpartener/edit.html.twig', array(
            'subPartener' => $subPartener,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subPartener entity.
     *
     */
    public function deleteAction(Request $request, subPartener $subPartener)
    {
        $form = $this->createDeleteForm($subPartener);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subPartener);
            $em->flush($subPartener);
        }

        return $this->redirectToRoute('subpartener_index');
    }

    /**
     * Creates a form to delete a subPartener entity.
     *
     * @param subPartener $subPartener The subPartener entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(subPartener $subPartener)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subpartener_delete', array('id' => $subPartener->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Edit status of request .
     *
     * @Route("/subPartener/list/", name="listSubPartener")
     *
     * @param string $id The bookingRequest ID
     * @param string $status The bookingRequest ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subs = $em->getRepository('FKSCentralBundle:subPartener')->findAll();

        return $this->render('subpartener/list.html.twig', array(
            'subs' => $subs,
        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/delete-sub-partener/", name="deleted_sub_partener")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function delAction(subPartener $subPartener)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($subPartener);
        $em->flush($subPartener);

        return $this->redirectToRoute('listSubPartener');
    }
}
