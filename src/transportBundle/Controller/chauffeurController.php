<?php

namespace transportBundle\Controller;

use transportBundle\Entity\chauffeur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Chauffeur controller.
 *
 */
class chauffeurController extends Controller
{
    /**
     * Lists all chauffeur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chauffeurs = $em->getRepository('transportBundle:chauffeur')->findAll();

        return $this->render('chauffeur/index.html.twig', array(
            'chauffeurs' => $chauffeurs,
        ));
    }
    public function pdfAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $chauffeurs=$em->getRepository("transportBundle:chauffeur")->findAll();
        $snappy=$this->get("knp_snappy.pdf");
        $html=$this->render("chauffeur/pdf.html.twig",array('chauffeurs'=>$chauffeurs,'title'=>'feuille de planning chauffeurs')
        );
        $filename="custom_pdf_from_twig";
        return new Response(
            $snappy->getOutputFromHtml($html),200,array('Content-Type'=>'application/pdf','Content-Dispoition'=>'inline; filename="'.$filename.'.pdf"')
        );
    }

    /**
     * Creates a new chauffeur entity.
     *
     */
    public function newAction(Request $request)
    {
        $chauffeur = new Chauffeur();
        $form = $this->createForm('transportBundle\Form\chauffeurType', $chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chauffeur);
            $em->flush();

            return $this->redirectToRoute('chauffeur_show', array('id' => $chauffeur->getId()));
        }

        return $this->render('chauffeur/new.html.twig', array(
            'chauffeur' => $chauffeur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a chauffeur entity.
     *
     */
    public function showAction(chauffeur $chauffeur)
    {
        $deleteForm = $this->createDeleteForm($chauffeur);

        return $this->render('chauffeur/show.html.twig', array(
            'chauffeur' => $chauffeur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing chauffeur entity.
     *
     */
    public function editAction(Request $request, chauffeur $chauffeur)
    {
        $deleteForm = $this->createDeleteForm($chauffeur);
        $editForm = $this->createForm('transportBundle\Form\chauffeurType', $chauffeur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chauffeur_edit', array('id' => $chauffeur->getId()));
        }

        return $this->render('chauffeur/edit.html.twig', array(
            'chauffeur' => $chauffeur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a chauffeur entity.
     *
     */
    public function deleteAction(Request $request, chauffeur $chauffeur)
    {
        $form = $this->createDeleteForm($chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chauffeur);
            $em->flush();
        }

        return $this->redirectToRoute('chauffeur_index');
    }

    /**
     * Creates a form to delete a chauffeur entity.
     *
     * @param chauffeur $chauffeur The chauffeur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(chauffeur $chauffeur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chauffeur_delete', array('id' => $chauffeur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
