<?php

namespace eventBundle\Controller;

use eventBundle\Entity\evennements;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Evennement controller.
 *
 */
class evennementsController extends Controller
{
    /**
     * Lists all evennement entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ev = $em->getRepository('eventBundle:evennements')->findAll();

        $lastIndex = end($ev);
        //var_dump($houssem);
        return $this->render('@event/Default/index.html.twig', array(
            'events' => $ev,
            'l' => $lastIndex
        ));
    }
    public function notifAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ev = $em->getRepository('eventBundle:evennements')->findAll();
        $lastIndex = end($ev);
        //var_dump($houssem);
        return $this->render('@event/Default/indexfront.html.twig', array(
            'events' => $ev,
            'l' => $lastIndex
        ));
    }
    /**
     * Creates a new evennement entity.
     *
     */
    public function newAction(Request $request)
    {
        $evennement = new evennements();
        $form = $this->createForm('eventBundle\Form\evennementsType', $evennement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evennement);
            $em->flush();

            return $this->redirectToRoute('event_homepage', array('id' => $evennement->getId()));
        }

        return $this->render('@event/create.html.twig', array(
            'evennement' => $evennement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evennement entity.
     *
     */


    /**
     * Displays a form to edit an existing evennement entity.
     * @param Request $request
     * @param evennements $evennement
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, evennements $evennement)
    {
        $deleteForm = $this->createDeleteForm($evennement);
        $editForm = $this->createForm('eventBundle\Form\evennementsType', $evennement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $evennement->getId()));
        }

        return $this->render('@event/edit.html.twig', array(
            'evennement' => $evennement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evennement entity.
     *
     */
    public function deleteAction(Request $request, evennements $evennement)
    {
        $form = $this->createDeleteForm($evennement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evennement);
            $em->flush();
        }

        return $this->redirectToRoute('event_homepage');
    }

    /**
     * Creates a form to delete a evennement entity.
     *
     * @param evennements $evennement The evennement entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(evennements $evennement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $evennement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function geoAction(evennements $evennement)
    {
        return $this->render('@event/Default/localisation.html.twig', array(
            'local' => $evennement));
    }
}
