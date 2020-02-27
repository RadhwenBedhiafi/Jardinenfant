<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Article;
use ForumBundle\Entity\Commentaire;
use ForumBundle\Form\ArticleType;
use ForumBundle\Form\CommentaireType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method createForm(string $class, Commentaire $com)
 * @method getDoctrine()
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Forum/Default/index.html.twig');
    }
    public function statAction(Request $request)
    {
        $pieChart=new PieChart();
        $em=$this->getDoctrine();
        $user=$em->getRepository(Commentaire::class)->findAll();
        $total=0;
        foreach ($user as $commentaires){
            $total=$total+1;
        }


        $najiba = $em->getRepository(Commentaire::class)->findBy(array('user' => 'najiba'));
        $data=array();
        $stat=['user','commentaire'];
        $nb=0;
        array_push($data,$stat);
        foreach($najiba as $commentaires){
            $stat=array();
            array_push($stat,'najiba',$commentaires->getId());
            $nb=$nb+1;
            $stat=[$commentaires->getUser(),$nb];
            array_push($data,$stat);
        }



        $neila = $em->getRepository(Commentaire::class)->findBy(array('user' => 'neila'));
        $data=array();
        $stat=['user','commentaire'];
        $nbF=0;
        array_push($data,$stat);
        foreach($neila as $commentaires){
            $stat=array();
            array_push($stat,'neila',$commentaires->getId());
            $nbF=$nbF+1;
            $stat=[$commentaires->getUser(),$nbF];
            array_push($data,$stat);
        }


        $adel = $em->getRepository(Commentaire::class)->findBy(array('user' => 'adel'));
        $data=array();
        $stat=['user','commentaire'];
        $nbA=0;
        array_push($data,$stat);
        foreach($adel as $commentaires){
            $stat=array();
            array_push($stat,'adel',$commentaires->getId());
            $nbA=$nbA+1;
            $stat=[$commentaires->getUser(),$nbA];
            array_push($data,$stat);
        }









        $pieChart->getData()->setArrayToDataTable(
            [
                ['Pac Man', 'Percentage'],
                ['najiba', $nb],
                ['neila',$nbF],
                ['adel',$nbA],

            ]
        );

        $pieChart->getOptions()->setTitle('Pourcentages des Commentaires par Auteur');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(750);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Forum\Default\state.html.twig', array('piechart' => $pieChart));

    }

    public function indexFAction()
    {
        return $this->render('@Forum/Default/indexF.html.twig');
    }

    public function consulterAction(Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findAll();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $article,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render('@Forum/Default/consulter.html.twig', array('A' => $result));

    }

    public function listeabAction(Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $article,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render('@Forum/Default/ListeArticlesBack.html.twig', array('A' => $result));
    }

    public function detailssAction(Article $article, Request $request, $id)
    {
        $commentaire=$this->getDoctrine()->getRepository(Commentaire::class)->findBy(['idArticle' => $article],['dateSaisie' => 'desc']);
        $newCommentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $newCommentaire );
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid() && $request->isMethod("post")){
            $em = $this->getDoctrine()->getManager();

            $newCommentaire->setIdArticle($article);
            $em->persist($newCommentaire);
            $em->flush();
            //persist the object $modele in the ORM
            //redirect the route after the add
            return $this->redirectToRoute('detailss', array('id'=> $article->getId()));


        }

        return $this->render('@Forum/Default/details.html.twig', array("x" => $article,'A'=>$commentaire, 'form'=>$form->createView()));

    }

    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Article::class)->find($id);

        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute("listeab");
    }

    public function modifierAction($id, Request $request)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $form = $this->createForm(ArticleType::class, $article);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('consulter');
        }
        return $this->render('@Forum/Default/modifierA.html.twig',
            array('form' => $form->createView()));

    }

    public function addAction(Request $request)
    {
        $article=new Article();
        //prepare the form with the function: createForm()
        $form=$this->createForm(ArticleType::class,$article);
        //extract the form answer from the received request
        $form=$form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){
            echo "<script> 
                function notifyMe() {
            if (!(\"Notification\" in window)) {
                alert(\"This browser does not support system notifications\");
            }
            else if (Notification.permission === \"granted\") {
                notify();
            }
            else if (Notification.permission !== 'denied') {
                Notification.requestPermission(function (permission) {
                    if (permission === \"granted\") {
                        notify();
                    }
                });
            }

            function notify() {
                var notification = new Notification('ARTICLE', {
                    icon: 'http://urls.ml/5yc3a',
                    body: \"Hey! Article modifié avec succés!\",

                });

                setTimeout(notification.close.bind(notification), 5000);
            }

        }
        notifyMe(); </script>";
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            //persist the object $modele in the ORM
            //redirect the route after the add
            return $this->redirectToRoute('consulter');

        }
        return $this->render('@Forum/Default/ajoutA.html.twig',
            array(
                'form'=>$form->createView()
            ));
    }


    public function deleteCAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository(Commentaire::class)->find($id);
        $com = $em->getRepository(Commentaire::class)->find($id)->getIdArticle();

        // $h = $commentaire->getIdArticle();

        $em->remove($commentaire);
        $em->flush();
        return $this->redirectToRoute("consulter");
    }
    public function modifierCAction($id, Request $request)
    {
        $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->find($id);
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form = $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('consulter');
        }
        return $this->render('@Forum/Default/modifierC.html.twig',
            array('form' => $form->createView()));

    }
    public function pdfAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $articles=$em->getRepository("ForumBundle:Article")->findAll();
        $snappy=$this->get("knp_snappy.pdf");
        $html=$this->render("@Forum/Default/pdf.html.twig",array('articles'=>$articles,'title'=>'Liste des articles')
        );
        $filename="custom_pdf_from_twig";
        return new Response(
            $snappy->getOutputFromHtml($html),200,array('Content-Type'=>'application/pdf','Content-Dispoition'=>'inline; filename="'.$filename.'.pdf"')
        );
    }



}




