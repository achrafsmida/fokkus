<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\subNetwork;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\OptionsResolver\Exception\AccessException;

/**
 * Subnetwork controller.
 *
 */
class subNetworkController extends Controller
{
    /**
     * Lists all subNetwork entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if ($user->hasRole('ROLE_ADMIN_GROUP') OR $user->hasRole('ROLE_NETWORK')) {
            $subNetworks = $em->getRepository('FKSCentralBundle:subNetwork')->getSubStartupByGroup($user->getGroup());
        } else {
            $subNetworks = $em->getRepository('FKSCentralBundle:subNetwork')->findAll();
        }

        //$subNetworks = $em->getRepository('FKSCentralBundle:subNetwork')->findAll();

        return $this->render('subnetwork/index.html.twig', array(
            'subNetworks' => $subNetworks,
        ));
    }

    /**
     * Creates a new subNetwork entity.
     *
     */
    public function newAction(Request $request)
    {
        $subNetwork = new Subnetwork();
        $user = $this->getUser();
        $group = null;
        if ($user->hasRole('ROLE_ADMIN_GROUP')){
            
            $group = $user->getGroup() ;
        }
        $form = $this->createForm('FKS\CentralBundle\Form\subNetworkType', $subNetwork, array('group' => $group));
        $form->handleRequest($request);


        //dump($this->getUser()->getGroup()->getName()); die;
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $subNetwork->uploadProfilePicture();
            $em->persist($subNetwork);
            $user = $subNetwork->getUser();
            if($user){
                $user->addRole('ROLE_NETWORK');
                $em->persist($user);
            }

            $em->flush();

            return $this->redirectToRoute('subnetwork_show', array('id' => $subNetwork->getId()));
        }

        return $this->render('subnetwork/new.html.twig', array(
            'subNetwork' => $subNetwork,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subNetwork entity.
     *
     */
    public function showAction(subNetwork $subNetwork)
    {
        $deleteForm = $this->createDeleteForm($subNetwork);

        return $this->render('subnetwork/show.html.twig', array(
            'subNetwork' => $subNetwork,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subNetwork entity.
     *
     */
    public function editAction(Request $request, subNetwork $subNetwork)
    {

        $user = $this->getUser();
        $group = null;
        if ($user->hasRole('ROLE_ADMIN_GROUP')){

            $group = $user->getGroup() ;
        }
        $em = $this->getDoctrine()->getManager();
        
        $deleteForm = $this->createDeleteForm($subNetwork);
        $editForm = $this->createForm('FKS\CentralBundle\Form\subNetworkType', $subNetwork, array('group' => $group));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $subNetwork->uploadProfilePicture();
            $em->persist($subNetwork);
            $user = $subNetwork->getUser();
            if($user){
                $user->addRole('ROLE_NETWORK');
                $em->persist($user);
            }

            $em->flush();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subnetwork_edit', array('id' => $subNetwork->getId()));
        }

        return $this->render('subnetwork/edit.html.twig', array(
            'subNetwork' => $subNetwork,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subNetwork entity.
     *
     */
    public function deleteAction(Request $request, subNetwork $subNetwork)
    {
        $form = $this->createDeleteForm($subNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subNetwork);
            $em->flush($subNetwork);
        }

        return $this->redirectToRoute('subnetwork_index');
    }

    /**
     * Creates a form to delete a subNetwork entity.
     *
     * @param subNetwork $subNetwork The subNetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(subNetwork $subNetwork)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subnetwork_delete', array('id' => $subNetwork->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Edit status of request .
     *
     * @Route("/sub/list/", name="listSub")
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

        $user = $this->getUser();
        if ($user->hasRole('ROLE_ADMIN_GROUP') OR $user->hasRole('ROLE_NETWORK')) {
            $subs = $em->getRepository('FKSCentralBundle:subNetwork')->getSubStartupByGroup($user->getGroup());
        } else {
            $subs = $em->getRepository('FKSCentralBundle:subNetwork')->findAll();
        }

       // $subs = $em->getRepository('FKSCentralBundle:subNetwork')->findAll();

        return $this->render('subnetwork/list.html.twig', array(
            'subs' => $subs,
        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/delete-sub/", name="deleted_sub")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function delAction(subNetwork $subNetwork)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($subNetwork);
        $em->flush($subNetwork);

        return $this->redirectToRoute('listSub');
    }
}
