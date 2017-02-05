<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\Partener;
use FKS\CentralBundle\Entity\subPartener;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Partener controller.
 *
 */
class PartenerController extends Controller
{
    /**
     * Lists all partener entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parteners = $em->getRepository('FKSCentralBundle:Partener')->findAll();

        return $this->render('partener/index.html.twig', array(
            'parteners' => $parteners,
        ));
    }

    /**
     * Creates a new partener entity.
     *
     */
    public function newAction(Request $request)
    {
        $partener = new Partener();
        $form = $this->createForm('FKS\CentralBundle\Form\PartenerType', $partener);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partener);
            $em->flush($partener);

            return $this->redirectToRoute('partener_show', array('id' => $partener->getId()));
        }

        return $this->render('partener/new.html.twig', array(
            'partener' => $partener,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a partener entity.
     *
     */
    public function showAction(Partener $partener)
    {
        $deleteForm = $this->createDeleteForm($partener);

        return $this->render('partener/show.html.twig', array(
            'partener' => $partener,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing partener entity.
     *
     */
    public function editAction(Request $request, Partener $partener)
    {
        $deleteForm = $this->createDeleteForm($partener);
        $editForm = $this->createForm('FKS\CentralBundle\Form\PartenerType', $partener);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partener_edit', array('id' => $partener->getId()));
        }

        return $this->render('partener/edit.html.twig', array(
            'partener' => $partener,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a partener entity.
     *
     */
    public function deleteAction(Request $request, Partener $partener)
    {
        $form = $this->createDeleteForm($partener);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partener);
            $em->flush($partener);
        }

        return $this->redirectToRoute('partener_index');
    }

    /**
     * Creates a form to delete a partener entity.
     *
     * @param Partener $partener The partener entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partener $partener)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partener_delete', array('id' => $partener->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/partener/display/", name="subPartener_show")
     *
     * @param string $id The bookingRequest ID
     * @param string $status The bookingRequest ID
     *
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function showSubAction(subPartener $sub, Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $id = $request->get('id');
        //dump($sub);die;
        return new JsonResponse(array('sub' => $sub->getLastName(),
            'firstName' => $sub->getFirstName(),
            'description' => $sub->getDescription()));

//        $deleteForm = $this->createDeleteForm($network);
//
//        return $this->render('network/show.html.twig', array(
//            'network' => $network,
//            'delete_form' => $deleteForm->createView(),
//        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/partener/list/", name="listPartener")
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

        $parteners = $em->getRepository('FKSCentralBundle:Partener')->findAll();

        return $this->render('partener/list.html.twig', array(
            'parteners' => $parteners,
        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/delete-partener/", name="deleted_partener")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function delAction(Partener $partener)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($partener);
        $em->flush($partener);

        return $this->redirectToRoute('listPartener');
    }
}
