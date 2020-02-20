<?php

namespace eventBundle\Controller;

use eventBundle\Entity\PlanEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Planevent controller.
 *
 */
class PlanEventController extends Controller
{
    /**
     * Lists all planEvent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $planEvents = $em->getRepository('eventBundle:PlanEvent')->findAll();

        return $this->render('@event/planEvent/planlist.html.twig', array(
            'planEvents' => $planEvents,
        ));


    }

    /**
     * Creates a new planEvent entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $planEvent = new PlanEvent();
        $form = $this->createForm('eventBundle\Form\PlanEventType', $planEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planEvent);
            $em->flush();

            return $this->redirectToRoute('plan_homepage');
        }

        return $this->render('@event/planEvent/create.html.twig', array(
            'planEvent' => $planEvent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a planEvent entity.
     *
     */
    public function showAction(PlanEvent $planEvent)
    {
        $deleteForm = $this->createDeleteForm($planEvent);

        return $this->render('@event/planEvent/show.html.twig', array(
            'planEvent' => $planEvent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing planEvent entity.
     *
     */
    public function editAction(Request $request, PlanEvent $planEvent)
    {
        $deleteForm = $this->createDeleteForm($planEvent);
        $editForm = $this->createForm('eventBundle\Form\PlanEventType', $planEvent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plan_homepage');
        }

        return $this->render('@event/planEvent/edit.html.twig', array(
            'planEvent' => $planEvent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a planEvent entity.
     *
     */
    public function deleteAction(Request $request, PlanEvent $planEvent)
    {
        $form = $this->createDeleteForm($planEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($planEvent);
            $em->flush();
        }

        return $this->redirectToRoute('plan_homepage');
    }

    /**
     * Creates a form to delete a planEvent entity.
     *
     * @param PlanEvent $planEvent The planEvent entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(PlanEvent $planEvent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('plan_delete', array('id' => $planEvent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
