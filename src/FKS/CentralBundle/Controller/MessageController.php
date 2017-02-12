<?php

namespace FKS\CentralBundle\Controller;

use FKS\CentralBundle\Entity\ContactUser;
use FKS\CentralBundle\Entity\Message;
use FKS\CentralBundle\Entity\User;
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
            $message->setDeleted(false);
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
        $em = $this->getDoctrine()->getManager();
        $count = count($em->getRepository('FKSCentralBundle:Message')->count($this->getUser()->getId()));
        $countReaded = count($em->getRepository('FKSCentralBundle:Message')->read($this->getUser()->getId()));
        //dump($count);die;

        $countSended = count($em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser()));
        $countDeleted = count($em->getRepository('FKSCentralBundle:Message')->delete($this->getUser()->getId()));

        return $this->render('message/show.html.twig', array(
            'message' => $message,
            'count' => $count,
            'countReaded' => $countReaded,
            'countSended' => $countSended,
            'countDeleted' => $countDeleted
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
            ->getForm();
    }

    /**
     * Lists all message entities.
     * @Route("/my-messages/", name="myMessages")
     */
    public function receivedMessagesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('FKSCentralBundle:Message')->findAll();

        $count = count($em->getRepository('FKSCentralBundle:Message')->count($this->getUser()->getId()));
        $countReaded = count($em->getRepository('FKSCentralBundle:Message')->read($this->getUser()->getId()));
        //dump($count);die;

        $countSended = count($em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser()));
        $countDeleted = count($em->getRepository('FKSCentralBundle:Message')->delete($this->getUser()->getId()));

        return $this->render('message/index.html.twig', array(
            'messages' => $messages,
            'count' => $count,
            'countReaded' => $countReaded,
            'countSended' => $countSended,
            'countDeleted' => $countDeleted
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

        $count = count($em->getRepository('FKSCentralBundle:Message')->count($this->getUser()->getId()));
        $countReaded = count($em->getRepository('FKSCentralBundle:Message')->read($this->getUser()->getId()));
        //dump($count);die;

        $countSended = count($em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser()));
        $countDeleted = count($em->getRepository('FKSCentralBundle:Message')->delete($this->getUser()->getId()));

        return $this->render('message/sended.html.twig', array(
//            'messagesSended' => $messagesSended,
            'messages' => $messages,
            'count' => $count,
            'countReaded' => $countReaded,
            'countSended' => $countSended,
            'countDeleted' => $countDeleted
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

        $count = count($em->getRepository('FKSCentralBundle:Message')->count($this->getUser()->getId()));
        $countReaded = count($em->getRepository('FKSCentralBundle:Message')->read($this->getUser()->getId()));
        //dump($count);die;

        $countSended = count($em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser()));
        $countDeleted = count($em->getRepository('FKSCentralBundle:Message')->delete($this->getUser()->getId()));

        return $this->render('message/readed.html.twig', array(
            'messages' => $messages,
            'count' => $count,
            'countReaded' => $countReaded,
            'countSended' => $countSended,
            'countDeleted' => $countDeleted
        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/delete-msg/", name="deleted_message")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function delAction(Message $message)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush($message);

        return $this->redirectToRoute('myMessages');
    }

    /**
     * Edit status of request .
     *
     * @Route("/delete-ajax/AA", name="deleted_ajax")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function deletedAjaxAction(Request $request)
    {
        $tab = $request->get('valeurs');
        //dump(array($tab));die;
        $em = $this->getDoctrine()->getManager();
//$tab2 = Integer.valueOf($tab);
        //dump(($tab2));die;
        foreach ($tab as $item) {
            //dump($item);die;
            $message = $em->getRepository('FKSCentralBundle:Message')->findOneById($item);
            //dump($message);die;
            $message->setDeleted(true);
            $em->flush($message);
        }


        return new JsonResponse(array('path' => $this->generateUrl('myMessages')));
        // return $this->redirectToRoute('myMessages');

    }

    /**
     * Lists all message entities.
     * @Route("/my-deleted-messages/", name="myDeletedMessages")
     */
    public function deletedMessagesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('FKSCentralBundle:Message')->delete($this->getUser());

        $count = count($em->getRepository('FKSCentralBundle:Message')->count($this->getUser()->getId()));
        $countReaded = count($em->getRepository('FKSCentralBundle:Message')->read($this->getUser()));
        //dump($count);die;

        $countSended = count($em->getRepository('FKSCentralBundle:Message')->findBySender($this->getUser()));
        $countDeleted = count($em->getRepository('FKSCentralBundle:Message')->delete($this->getUser()));

        return $this->render('message/deleted.html.twig', array(
            'messages' => $messages,
            'count' => $count,
            'countReaded' => $countReaded,
            'countSended' => $countSended,
            'countDeleted' => $countDeleted
        ));
    }

    /**
     * Edit status of request .
     *
     * @Route("/{id}/send-msg/", name="send_contact")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function sendFirstContactAction(User $receiver)
    {
        $em = $this->getDoctrine()->getManager();
        $currentUser = $this->getUser();

        $contact = count($em->getRepository('FKSCentralBundle:ContactUser')->getContactUser($receiver->getId(), $currentUser->getId()));
        // dump($contact); die;
        if ($contact == 0) {
            $contactUser = new ContactUser();
            $contactUser->setSender($currentUser);
            $contactUser->setReceiver($receiver);
            $contactUser->setStatus(true);

            $em->persist($contactUser);
            $em->flush($contactUser);

            return new JsonResponse(array('msg' => 1));
        } elseif ($contact->getStatus == 0) {
            return new JsonResponse(array('path' => 1));

        }else{
            return new JsonResponse(array('path' => 0));
        }

    }


    /**
     * Edit status of request .
     *
     * @Route("/{id}/send-form/", name="send_form_message")
     * @return array
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If bookingRequest doesn't exists
     */
    public function sendAction(Request $request, User $receiver)
    {
//        $message = new Message();
//        $form = $this->createForm('FKS\CentralBundle\Form\MessageContactType', $message);
//        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {

        $subject = $request->get('subject');
        $message = $request->get('message');
        $em = $this->getDoctrine()->getManager();

        $message->setSubject($subject);
        $message->setMessage($message);
        
        $message->setSender($this->getUser());
        $message->addUser($receiver);
        $message->setReaded(false);
        $message->setDeleted(false);
        $em->persist($message);
        $em->flush($message);

        return $this->redirectToRoute('message_show', array('id' => $message->getId()));
        // }

//        return $this->render('network/send.html.twig', array(
//            'message' => $message,
//            'form_send' => $form->createView(),
//        ));
    }
}
