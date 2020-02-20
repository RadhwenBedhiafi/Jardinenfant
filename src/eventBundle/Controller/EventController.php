<?php

namespace eventBundle\Controller;

use eventBundle\Entity\evennements;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
public function showAction(){
    $em = $this->getDoctrine()->getManager();
    $event =$em->getRepository('eventBundle:evennements')->findAll();
    return$this->render('@eventBundle/Default/index.html.twig', array(
        'event' => $event
    ));
}
public function editAction(Request $request, evennements $event)
{

    $deleteForm = $this->createDeleteForm();
    $editForm = $this->createForm('eventBundle\Form\evennementsType', $event);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('', array('id' => $event->getId()));
    }
    return $this->render('@eventbundle/Default/edit.html.twig', array(
        'event' => $event,
        'edit_form' => $editForm->createView(),
        'delete_form' => $deleteForm->createView(),
    ));
}
}
