<?php

namespace cantineBundle\Controller;

use cantineBundle\Entity\plats;
use cantineBundle\Entity\ticket;
use cantineBundle\Form\platsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Plat controller.
 *
 * @Route("plats")
 */
class platsController extends Controller
{
    /**
     * Lists all plat entities.
     *
     * @Route("/", name="plats_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('cantineBundle:plats')->findAll();

        return $this->render('plats/plat1.html.twig', array(
            'plats' => $plats,
        ));
    }


    public function showbackAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('cantineBundle:plats')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $plats,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render('plats/crud_e.html.twig', array(
            'plats' => $result,
        ));
    }



    /**
     * Creates a new plat entity.
     *
     * @Route("/new", name="plats_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plat = new plats();
        $form = $this->createForm('cantineBundle\Form\platsType', $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            return $this->redirectToRoute('plats_show', array('id' => $plat->getId()));
        }

        return $this->render('plats/new.html.twig', array(
            'plat' => $plat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plat entity.
     *
     * @Route("/{id}", name="plats_show")
     * @Method("GET")
     */
    public function showAction(plats $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);

        return $this->render('plats/show.html.twig', array(
            'plat' => $plat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plat entity.
     *
     * @Route("/{id}/edit", name="plats_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, plats $plat)
    {
        $deleteForm = $this->createDeleteForm($plat);
        $editForm = $this->createForm('cantineBundle\Form\platsType', $plat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plats_edit', array('id' => $plat->getId()));
        }

        return $this->render('plats/edit.html.twig', array(
            'plat' => $plat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plat entity.
     *
     * @Route("/{id}", name="plats_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, plats $plat)
    {
        $form = $this->createDeleteForm($plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plat);
            $em->flush();
        }

        return $this->redirectToRoute('plats_index');
    }

    /**
     * Creates a form to delete a plat entity.
     *
     * @param plats $plat The plat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(plats $plat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('plats_delete', array('id' => $plat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Lists all plat entities.
     *
     * @Route("/", name="plats_index")
     * @Method("GET")
     */
    public function indexfrontAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plats = $em->getRepository('cantineBundle:plats')->findAll();

        return $this->render('plats/indexfront.html.twig', array(
            'plats' => $plats,
        ));
    }





    public function addAction(Request $request){
        //$membre=$this->container->get('security.token_storage')->getToken()->getUser()->getId();
        $club = new plats();


        $form = $this->createForm(platsType::class,$club);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted()  && $form->isValid()) {

            $file= $request->files->get('cantinebundle_plats')['photoPlat'];
            $uploads_directory=$this->getParameter('uploads_directory');


            var_dump($file);
            $photoPlat=$file->getClientoriginalName();

            $em = $this->getDoctrine()->getManager();

            $file->move($uploads_directory,$photoPlat);
            $club->setPhotoPlat($photoPlat);


           $em->persist($club);
            $em->flush();
            return $this->redirectToRoute("show_back");
        }
        return $this->render('plats/new.html.twig',array('form' => $form->createView()));
    }


    public function modifierAction($id , Request $request) {
        $plat = new plats();
        $em = $this->getDoctrine()->getManager();
        $plat = $em->getRepository(plats::class)->find($id);
        $photoPlat=$plat->getPhotoPlat();
        $plat->setPhotoPlat("az");
        $form = $this->createForm(platsType::class,$id);

        $form = $form->handleRequest($request);

        if ($form->isSubmitted())
        {

            if ($plat->getPhotoPlat()=="az" && $request->files->get('cantinebundle')['photoPlat']==null ) {

                $plat->setPhotoPlat($id);
                $em->persist($plat);
                $em->flush();
                return $this->redirectToRoute("show_back");

            }

            $file= $request->files->get('cantinebundle')['photoPlat'];
            $uploads_directory=$this->getParameter('uploads_directory');



            $imageEvent=$file->getClientoriginalName();

            $file->move($uploads_directory,$imageEvent);
//var_dump($file);
            $plat->setPhotoPlat($photoPlat);



            $em->persist($plat);
            $em->flush();
            return $this->redirectToRoute("show_back");
        }
        return $this->render('plat/index.html.twig',array('form' => $form->createView(),'id'=>$id));


    }


    public function chercherAction()
    {


        $connect = mysqli_connect("localhost", "root", "", "jardinenfant");
        $output = '';
        $a = '';

        if(isset($_POST["query"]))
        {
            $search = mysqli_real_escape_string($connect, $_POST["query"]);
            if(strlen($search)>0){
                $query = "
	SELECT * FROM plats 
	WHERE nomPlat LIKE '%".$search."%'
	
	
	";
            }
            else
            {
                $query = "
	SELECT * FROM plats ORDER BY id DESC ";
            }
            $result = mysqli_query($connect, $query);

            if(mysqli_num_rows($result) > 0)
            {
                $output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>nom du plat</th>
							<th> description </th>
							
							
						</tr>';
                while($row = mysqli_fetch_array($result))
                {

                    $output .= '
			 
	<tr> <td>	<a href="#"	<td>'.$row["nomPlat"].' </td> </a>
             <td>
             '.$row["description"].' 
</td>
        
              
               </tr>
							
		';

                }
                echo $output;
            }
            else
            {
                echo 'Data Not Found';
            }

            return $this->render('plats/chercher.html.twig'
            );
        }
    }


    public function supAction($id) {


        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(plats::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute("show_back");
    }


    public function suptAction($id) {


        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(ticket::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute("show");
    }



    public function modifierevAction($id , Request $request) {
        $club = new plats();
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(plats::class)->find($id);
        $image=$club->getPhotoPlat();
        $club->setPhotoPlat("az");
        $form = $this->createForm(platsType::class,$club);

        $form = $form->handleRequest($request);

        if ($form->isSubmitted())
        {

            if ($club->getPhotoPlat()=="az" && $request->files->get('cantinebundle')['photoPlat']==null ) {

                $club->setPhotoPlat($image);
                $em->persist($club);
                $em->flush();
                return $this->redirectToRoute("show_back");

            }

            $file= $request->files->get('cantinebundle')['photoPlat'];
            $uploads_directory=$this->getParameter('uploads_directory');



            $imageEvent=$file->getClientoriginalName();

            $file->move($uploads_directory,$imageEvent);
//var_dump($file);
            $club->setPhotoPlat($imageEvent);



            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute("show_back");
        }
        return $this->render('plats/edit.html.twig',array('Form' => $form->createView()));


    }



    public function resAction($id , Request $request){

        $club = new plats();
        $res= new ticket();
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(plats::class)->find($id);





            $res->setIdPlat($id);
            $res->setIdUser(1);

            $res->setDate($club->getDate());

            $res->setNomPlat($club->getNomPlat());
            $res->setPhotoPlat($club->getPhotoPlat());

            $em->persist($res);
            $em->flush();


        $res = $em->getRepository(ticket::class)->findAll();






        return $this->render('plats/reserv.html.twig',array('res'=>$res));
    }

    public function tiketAction($id) {

        $em = $this->getDoctrine()->getManager();
        $tiket = $em->getRepository(ticket::class)->find($id);


        return $this->render('plats/tiket.html.twig',array('tiket'=>$tiket));
    }


}
