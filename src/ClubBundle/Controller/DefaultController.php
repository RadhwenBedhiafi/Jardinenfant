<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Club;
use ClubBundle\Entity\Demandedad;
use ClubBundle\Form\ClubType;
use ClubBundle\Form\DemandedadType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class DefaultController extends Controller
{

    public function indexAction()
{
    $Club=$this->getDoctrine()->getRepository(Club::class)->findAll();
    return $this->render('@Club/Default/index.html.twig',array('Q'=>$Club));
}

    public function StatAction()
    {
        $pieChart= new PieChart();
        $em= $this->getDoctrine();
        $clubs = $em->getRepository(Club::class)->findAll();
        $totalclub=0;
        foreach($clubs as $Club) {
            $totalclub=$totalclub+$Club->getCapacite();
        }

        $data= array();
        $stat=['Club', 'capacite'];
        $nb=0;
        array_push($data,$stat);
        foreach($clubs as $Club) {
            $stat=array();
            array_push($stat,$Club->getNomclub(),(($Club->getCapacite()) ));
            $nb=($Club->getCapacite() );
            $stat=[$Club->getNomclub(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des club par capacite');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('@Club/Default/state.html.twig', array('piechart' =>$pieChart));
    }



    public function consulterdAction(Request $request)
    {
        $demande=$this->getDoctrine()->getRepository(Demandedad::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator' );
        $result = $paginator->paginate(
            $demande,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('@Club/Default/listedemandes.html.twig',array('A'=>$result));
    }


    public function backindexAction(Request $request)
    {
        $Club=$this->getDoctrine()->getRepository(Club::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator' );
        $result = $paginator->paginate(
            $Club,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );
        return $this->render('@Club/Default/backindex.html.twig',array('A'=>$result));
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
    public function pdfdAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $demandes=$em->getRepository("ClubBundle:Demandedad")->findAll();
        $snappy=$this->get("knp_snappy.pdf");
        $html=$this->render("@Club/Default/pdf.html.twig",array('demandes'=>$demandes,'title'=>'Liste des demandes')
        );
        $filename="custom_pdf_from_twig";
        return new Response(
            $snappy->getOutputFromHtml($html),200,array('Content-Type'=>'application/pdf','Content-Dispoition'=>'inline; filename="'.$filename.'.pdf"')
        );
    }


}

