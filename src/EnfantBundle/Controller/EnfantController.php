<?php


namespace EnfantBundle\Controller;


use EnfantBundle\Entity\Classe;
use EnfantBundle\Entity\Enfant;
use EnfantBundle\Form\ClasseType;
use EnfantBundle\Form\EnfantType;
use EnfantBundle\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\Response;




class EnfantController extends Controller
{
    public function inscriptionAction(Request $request){

        $enfant=new Enfant();
        $form=$this->createForm(InscriptionType::class,$enfant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($enfant);
            $em->flush();
            return $this->redirectToRoute("enfant_inscriptiontermine");
        }
        return $this->render("@Enfant/Enfant/inscription.html.twig",array('form'=>$form->createView()));
    }


    public function affecterAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $enfant = $em->getRepository("EnfantBundle:Enfant")->find($id);
        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($enfant);
            $em->flush();
            return $this->redirectToRoute("enfant_listenfant");
        }
                return $this->render("@Enfant/Enfant/affecter.html.twig", array('form' => $form->createView()));

        }


    public function listenfantAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $enfants=$em->getRepository("EnfantBundle:Enfant")->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $enfants,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render("@Enfant/Enfant/listenfant.html.twig",array('enfants'=>$result));
    }

    public function deleteenfantAction(Request $request, $id)
    {
        $enfant= new Enfant();
        $em=$this->getDoctrine()->getManager();
        $enfant=$em->getRepository("EnfantBundle:Enfant")->findOneById($id);
        $em->remove($enfant);
        $em->flush();
        return $this->redirectToRoute("enfant_listenfant");
    }

    public function updateenfantAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $enfant=$em->getRepository("EnfantBundle:Enfant")->find($id);
        $form=$this->createForm(InscriptionType::class,$enfant);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid())
        {
            $em->persist($enfant);
            $em->flush();
            return $this->redirectToRoute("enfant_listenfant");
        }
        return $this->render("@Enfant/Enfant/updateenfant.html.twig",array('form'=>$form->createView()));

    }
    public function rechercheAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $enfants=$em->getRepository("EnfantBundle:Enfant")->findAll();
        if ($request->isMethod('POST'))
        {
            $id=$request->get('id');
            $enfants=$em->getRepository("EnfantBundle:Enfant")->findBy(array("id"=>$id));

        }
        return $this->render("@Enfant/Enfant/recherche.html.twig",array("enfants"=>$enfants));

    }
    public function pdfAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $enfants=$em->getRepository("EnfantBundle:Enfant")->findAll();
        $snappy=$this->get("knp_snappy.pdf");
        $html=$this->render("@Enfant/Enfant/pdf.html.twig",array('enfants'=>$enfants,'title'=>'Liste des enfants')
        );
        $filename="custom_pdf_from_twig";
        return new Response(
            $snappy->getOutputFromHtml($html),200,array('Content-Type'=>'application/pdf','Content-Dispoition'=>'inline; filename="'.$filename.'.pdf"')
        );
    }

    public function inscriptiontermineAction(){

            return $this->render('@Enfant/Enfant/inscriptiontermine.html.twig');
    }






}