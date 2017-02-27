<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\Statistique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\OptionsResolver\Exception\AccessException;

/**
 * Statistique controller.
 *
 * @Route("statistique")
 */
class StatistiqueController extends Controller
{
    /**
     * Lists all statistique entities.
     *
     * @Route("/", name="statistique_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $sub = $em->getRepository('FKSCentralBundle:SubNetwork')->findOneByUser($user);
        $group = $sub->getNetwork()->getGroup();
        if ($user->hasRole('ROLE_NETWORK')) {

            $stats = $em->getRepository('FKSCentralBundle:Statistique')->findBySub($sub);

        } elseif ($user->hasRole('ROLE_ADMIN_GROUP')) {
            $stats = $em->getRepository('FKSCentralBundle:Statistique')->getStatistiqueByGroup($group);
        } else {
            $stats = $em->getRepository('FKSCentralBundle:Statistique')->findAll();
        }

        //dump($result);die;

        return $this->render('statistique/index.html.twig', array(
            'stats' => $stats,
            //  'hotelUnhappy' => $hotelUnhappy,

        ));

        //return new Response(json_encode($result));
    }

    /**
     * Creates a new statistique entity.
     *
     * @Route("/new", name="statistique_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $statistique = new Statistique();

        $form = $this->createForm('FKS\CentralBundle\Form\StatistiqueType', $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $subNetworks = $em->getRepository('FKSCentralBundle:subNetwork')->findOneByUser($user);
            //dump($subNetworks);die;
            $statistique->setSub($subNetworks);
            $em->persist($statistique);
            $em->flush($statistique);

            return $this->redirectToRoute('statistique_index');
        }

        return $this->render('statistique/new.html.twig', array(
            'statistique' => $statistique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a statistique entity.
     *
     * @Route("/{id}", name="statistique_show")
     * @Method("GET")
     */
    public function showAction(Statistique $statistique)
    {
        $deleteForm = $this->createDeleteForm($statistique);

        return $this->render('statistique/show.html.twig', array(
            'statistique' => $statistique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing statistique entity.
     *
     * @Route("/{id}/edit", name="statistique_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Statistique $statistique)
    {
        $deleteForm = $this->createDeleteForm($statistique);
        $editForm = $this->createForm('FKS\CentralBundle\Form\StatistiqueType', $statistique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('statistique_edit', array('id' => $statistique->getId()));
        }

        return $this->render('statistique/edit.html.twig', array(
            'statistique' => $statistique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a statistique entity.
     *
     * @Route("/{id}", name="statistique_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Statistique $statistique)
    {
        $form = $this->createDeleteForm($statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statistique);
            $em->flush($statistique);
        }

        return $this->redirectToRoute('statistique_index');
    }

    /**
     * Creates a form to delete a statistique entity.
     *
     * @param Statistique $statistique The statistique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Statistique $statistique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('statistique_delete', array('id' => $statistique->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

//    /**
//     * Display stats of  of application .
//     *
//     * @Route("/stats", name="stats")
//     *
//     *
//     * @return array
//     */
//    public function statisticAction(Request $request)
//    {
//
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getManager();
//
//        $stats = $em->getRepository('FKSCentralBundle:Statistique')->findAll();
//
//
//        $result[] = array('application'=>[
//
//            'stats' => $stats,
//        ]
//
//        );
//
//        return $this->render('default/index.html.twig', array(
//            'result' => $result,
//            //  'hotelUnhappy' => $hotelUnhappy,
//
//        ));
//
//        //return new Response(json_encode($result));
//    }

}
