<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Article;
use ForumBundle\Entity\Commentaire;
use ForumBundle\Form\ArticleType;
use ForumBundle\Form\CommentaireType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

    public function indexFAction()
    {
        return $this->render('@Forum/Default/indexF.html.twig');
    }

    public function consulterAction()
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('@Forum/Default/consulter.html.twig', array('A' => $article));
    }

    public function listeabAction()
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('@Forum/Default/ListeArticlesBack.html.twig', array('A' => $article));
    }

    public function detailsAction(Article $article, Request $request, $id)
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
            return $this->redirectToRoute('details', array('id'=> $article->getId()));


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

}




