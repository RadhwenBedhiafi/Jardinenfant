<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Club;
use ClubBundle\Entity\Demandedad;
use ClubBundle\Form\ClubType;
use ClubBundle\Form\DemandedadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction()
{
    $Club=$this->getDoctrine()->getRepository(Club::class)->findAll();
    return $this->render('@Club/Default/index.html.twig',array('Q'=>$Club));
}
    public function consulterdAction()
    {
        $demande=$this->getDoctrine()->getRepository(Demandedad::class)->findAll();
        return $this->render('@Club/Default/listedemandes.html.twig',array('A'=>$demande));
    }


    public function backindexAction()
    {
        $Club=$this->getDoctrine()->getRepository(Club::class)->findAll();
        return $this->render('@Club/Default/backindex.html.twig',array('A'=>$Club));
    }
    public function parentPageAction()
    {
        $Club=$this->getDoctrine()->getRepository(Club::class)->findAll();
        return $this->render('@Club/Default/index.html.twig',array('A'=>$Club));
    }
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $Club = $em->getRepository(Club::class)->find($id);

        $em->remove($Club);
        $em->flush();
        return $this->redirectToRoute("backindex");
    }
    public function modifierAction($id, Request $request)
    {
        $Club = $this->getDoctrine()->getRepository(Club::class)->find($id);
        $form = $this->createForm(ClubType::class, $Club);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('backindex');
        }
        return $this->render('@Club/Default/modifier.html.twig',
            array('form' => $form->createView()));

    }

    public function addAction(Request $request)
    {
        $club=new Club();
        //prepare the form with the function: createForm()
        $form=$this->createForm(ClubType::class,$club);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            //persist the object $modele in the ORM
            //redirect the route after the add
            return $this->redirectToRoute('club_homepage');

        }
        return $this->render('@Club/Default/ajout.html.twig',
            array(
                'form'=>$form->createView()
            ));
    }


    public function  detailsAction(Club $club){

        return $this->render('@Club/Default/Details.html.twig', array("x"=>$club));


    }

    public function demandeaddAction(Request $request)
    {
        $demandedad=new Demandedad();
        //prepare the form with the function: createForm()
        $form=$this->createForm(DemandedadType::class,$demandedad);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($demandedad);
            $em->flush();
            //persist the object $modele in the ORM
            //redirect the route after the add
            return $this->redirectToRoute('club_homepage');

        }
        return $this->render('@Club/Default/ajoutdemande.html.twig',
            array(
                'form'=>$form->createView()
            ));
    }

    public function deletedAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $demande = $em->getRepository(Demandedad::class)->find($id);

        $em->remove($demande);
        $em->flush();
        return $this->redirectToRoute("consulterdem");
    }
    public function modifierdAction($id, Request $request)
    {
        $demande = $this->getDoctrine()->getRepository(Demandedad::class)->find($id);
        $form = $this->createForm(DemandedadType::class, $demande);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('consulterdem');
        }
        return $this->render('@Club/Default/modifierd.html.twig',
            array('form' => $form->createView()));

    }


}

