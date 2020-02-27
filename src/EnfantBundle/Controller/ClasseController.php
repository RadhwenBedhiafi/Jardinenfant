<?php


namespace EnfantBundle\Controller;


use EnfantBundle\Entity\Classe;
use EnfantBundle\Form\ClasseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends Controller
{
    public function ajoutAction(Request $request){
        $classe=new Classe();
        $form=$this->createForm(ClasseType::class,$classe);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();
            return $this->redirectToRoute("classe_list");
        }
        return $this->render("@Enfant/Classe/ajout.html.twig",array('form'=>$form->createView()));
    }

    public function listAction()
    {
        $em=$this->getDoctrine()->getManager();
        $classes=$em->getRepository("EnfantBundle:Classe")->findAll();
        return $this->render("@Enfant/Classe/list.html.twig",array('classes'=>$classes));
    }

    public function deleteAction(Request $request, $id)
    {
        $classe= new Classe();
        $em=$this->getDoctrine()->getManager();
        $classe=$em->getRepository("EnfantBundle:Classe")->find($id);
        $em->remove($classe);
        $em->flush();
        return $this->redirectToRoute("classe_list");
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $classe=$em->getRepository("EnfantBundle:Classe")->find($id);
        $form=$this->createForm(ClasseType::class,$classe);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid())
        {
            $em->persist($classe);
            $em->flush();
            return $this->redirectToRoute("classe_list");
        }
        return $this->render("@Enfant/Classe/update.html.twig",array('form'=>$form->createView()));

    }
    public function rechercheclasseAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $classes=$em->getRepository("EnfantBundle:Classe")->findAll();
        if ($request->isMethod('POST'))
        {
            $id=$request->get('id');
            $classes=$em->getRepository("EnfantBundle:Classe")->findBy(array("id"=>$id));

        }
        return $this->render("@Enfant/Classe/recherche.html.twig",array("classes"=>$classes));

    }

}