<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\OptionsResolver\Exception\AccessException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Message controller.
 *
 */
class MessageController extends Controller
{
    /**
     * Lists all message entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('FKSCentralBundle:Message')->findAll();

        return $this->render('message/index.html.twig', array(
            'messages' => $messages,
        ));
    }

    /**
     * Creates a new message entity.
     *
     */
    public function newAction(Request $request)
    {
        $message = new Message();
        $form = $this->createForm('FKS\CentralBundle\Form\MessageType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message->setSender($this->getUser());
            $message->setReaded(false);
            $em->persist($message);
            $em->flush($message);

            return $this->redirectToRoute('message_show', array('id' => $message->getId()));
        }

        return $this->render('message/new.html.twig', array(
            'message' => $message,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a message entity.
     *
     */
    public function showAction(Message $message)
    {
        $deleteForm = $this->createDeleteForm($message);

        return $this->render('message/show.html.twig', array(
            'message' => $message,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing message entity.
     *
     */
    public function editAction(Request $request, Message $message)
    {
        $deleteForm = $this->createDeleteForm($message);
        $editForm = $this->createForm('FKS\CentralBundle\Form\MessageType', $message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('message_edit', array('id' => $message->getId()));
        }

        return $this->render('message/edit.html.twig', array(
            'message' => $message,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a message entity.
     *
     */
    public function deleteAction(Request $request, Message $message)
    {
        $form = $this->createDeleteForm($message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush($message);
        }

        return $this->redirectToRoute('message_index');
    }

    /**
     * Creates a form to delete a message entity.
     *
     * @param Message $message The message entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Message $message)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('message_delete', array('id' => $message->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Lists all message entities.
     * @Route("/my-messages/", name="myMessages")
     */
    public function receivedMessagesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('FKSCentralBundle:Message')->findAll();

        return $this->render('message/index.html.twig', array(
            'messages' => $messages,
        ));
    }

    /**
     * Lists all message entities.
     * @Route("/sended-messages/", name="sendedMessages")
     */
    public function sendedMessagesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser());

        return $this->render('message/sended.html.twig', array(
            'messages' => $messages,
        ));
    }

    /**
     * Lists all message entities.
     * @Route("/readed-messages/", name="readedMessages")
     */
    public function readedMessagesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser());

        return $this->render('message/readed.html.twig', array(
            'messages' => $messages,
        ));
    }
}
