<?php

namespace transportBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use transportBundle\Entity\ligneTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

/**
 * Lignetransport controller.
 *
 */
class ligneTransportController extends Controller
{
    /**
     * Lists all ligneTransport entities.
     *
     */
    public function indexbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();

        return $this->render('lignetransport/index.html.twig', array(
            'ligneTransports' => $ligneTransports,
        ));
    }

    /**
     * Lists all ligneTransport entities.
     *
     */
    public function gererDemandeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('lignetransport/index.html.twig', array(
            'ligneTransports' => $ligneTransports,
            'users' => $users,
        ));
    }

    /**
     * Creates a new ligneTransport entity.
     *
     */
    public function newAction(Request $request)
    {
        $ligneTransport = new Lignetransport();
        $form = $this->createForm('transportBundle\Form\ligneTransportType', $ligneTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligneTransport);
            $em->flush();

            return $this->redirectToRoute('lignetransport_show', array('id' => $ligneTransport->getId()));
        }

        return $this->render('lignetransport/new.html.twig', array(
            'ligneTransport' => $ligneTransport,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ligneTransport entity.
     *
     */
    public function showAction(ligneTransport $ligneTransport)
    {
        $deleteForm = $this->createDeleteForm($ligneTransport);
        $em = $this->getDoctrine()->getManager();
        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();


        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');

        $query = $repository->createQueryBuilder('p')
            ->where('p.ligneTransport = :id')
            ->setParameter('id', $ligneTransport->getId())
            ->getQuery();

        $users = $query->getResult();


        return $this->render('lignetransport/show.html.twig', array(
            'ligneTransport' => $ligneTransport,
            'ligneTransports' => $ligneTransports,
            'users' => $users,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ligneTransport entity.
     *
     */
    public function editAction(Request $request, ligneTransport $ligneTransport)
    {
        $deleteForm = $this->createDeleteForm($ligneTransport);
        $editForm = $this->createForm('transportBundle\Form\ligneTransportType', $ligneTransport);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lignetransport_edit', array('id' => $ligneTransport->getId()));
        }

        return $this->render('lignetransport/edit.html.twig', array(
            'ligneTransport' => $ligneTransport,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ligneTransport entity.
     *
     */
    public function deleteAction(Request $request, ligneTransport $ligneTransport)
    {
        $form = $this->createDeleteForm($ligneTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ligneTransport);
            $em->flush();
        }

        return $this->redirectToRoute('lignetransport_index');
    }

    /**
     * Creates a form to delete a ligneTransport entity.
     *
     * @param ligneTransport $ligneTransport The ligneTransport entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ligneTransport $ligneTransport)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lignetransport_delete', array('id' => $ligneTransport->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
    /**
     * Lists all ligneTransport entities.
     *
     */
    public function indexfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();

        return $this->render('lignetransport/indexfront.html.twig', array(
            'ligneTransports' => $ligneTransports,
        ));
    }

    /**
     * Finds and displays a ligneTransport entity.
     *
     */
    public function showfAction(ligneTransport $ligneTransport)
    {
        $deleteForm = $this->createDeleteForm($ligneTransport);

        return $this->render('lignetransport/showFront.html.twig', array(
            'ligneTransport' => $ligneTransport,
            'delete_form' => $deleteForm->createView(),
        ));
    }









    public function demanderLigneAction($id)
    {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $ligneTransport = $em->getRepository(ligneTransport::class)->find($id);
        $user=$this->getUser();
        $user->setLigneTransport($ligneTransport);
        $em->persist($user);
        $em->flush();
        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();

        return $this->render('lignetransport/indexfront.html.twig', array(
            'ligneTransports' => $ligneTransports,
        ));
        //remove from the ORM
//        $em->remove($Planning_traitement_medical);
//        //update the data base
//        return $this->redirectToRoute("afficherTraitement");
//        return $this->render('lignetransport/showFront.html.twig');
    }











//    public function traiterdemandeAction()
//    {
//        $ligneTransport= $this->getDoctrine()->getManager()->getRepository(ligneTransport::class)->
//        findBy(['etat'=>0]);
//        return $this->render("ligneTransport/traiter.html.twig",array('ligneTransport'=>$ligneTransport));
//    }

    /**
     * Finds and displays a ligneTransport entity.
     *
     */
    public function accepterdemandeAction(User $user)
    {
        $em=$this->getDoctrine()->getManager();
        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();

        $user=$em->getRepository('AppBundle:User')->find($user->getId());
        $linedetransport=$em->getRepository(ligneTransport::class)->find($user->getLigneTransport());
        $nb = $linedetransport->getNbPlaces();
        $linedetransport->setNbPlaces($nb+1);


        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');

        $query = $repository->createQueryBuilder('p')
            ->where('p.ligneTransport = :id')
            ->setParameter('id', $linedetransport->getId())
            ->getQuery();

        $users = $query->getResult();

        $deleteForm = $this->createDeleteForm($linedetransport);


        $user->setValid(1);
        $em->persist($user);
        $em->flush();
        return $this->render('lignetransport/show.html.twig', array(
            'ligneTransport' => $linedetransport,
            'ligneTransports' => $ligneTransports,
            'users' => $users,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function refuserdemandeAction(User $user)
    {
        var_dump($user->getId());
        $em=$this->getDoctrine()->getManager();
        $ligneTransports = $em->getRepository('transportBundle:ligneTransport')->findAll();

        $user=$em->getRepository('AppBundle:User')->find($user->getId());
        $linedetransport=$em->getRepository(ligneTransport::class)->find($user->getLigneTransport());
        $nb = $linedetransport->getNbPlaces();
        $linedetransport->setNbPlaces($nb-1);

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:User');

        $query = $repository->createQueryBuilder('p')
            ->where('p.ligneTransport = :id')
            ->setParameter('id', $linedetransport->getId())
            ->getQuery();

        $users = $query->getResult();
        $deleteForm = $this->createDeleteForm($linedetransport);

        $user->setValid(0);
        $em->persist($user);
        $em->flush();
        return $this->render('lignetransport/show.html.twig', array(
            'ligneTransport' => $linedetransport,
            'ligneTransports' => $ligneTransports,
            'users' => $users,
            'delete_form' => $deleteForm->createView(),
        ));
    }
//    public function refuserdemandeAction($id)
//    {
//        $em=$this->getDoctrine()->getManager();
//        $conge=$em->getRepository(ligneTransport::class)->find($id);
//        $conge->setEtatLigneTransport(1);
//        $em->persist($conge);
//        $em->flush();
//        return $this->redirectToRoute('refuser_demande');
//    }
    public function statistiqueAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $ligneTransports = $em->getRepository(ligneTransport::class)->findAll();
        $total=0;

        foreach($ligneTransports as $ligneTransport) {
            $total=$total+$ligneTransport->getNbPlaces();
        }

        $data= array();
        $stat=['ligneTransport', 'NbPlaces'];
        $nb=0;
        array_push($data,$stat);
        foreach($ligneTransports as $ligneTransport) {
            $stat=array();
            array_push($stat,$ligneTransport->getStation(),(($ligneTransport->getNbPlaces()) *100)/$total);
            $nb=($ligneTransport->getNbPlaces() *100)/$total;
            $stat=[$ligneTransport->getStation(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des lignes de Transport par nombre de places');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('lignetransport/graphe.html.twig', array('piechart' => $pieChart));
    }


    /**
     * affichage des notification en front end sans besoin de console
     *
     */
    public function afficherNotifAction () {

        $notifications=$this->getDoctrine()->getManager()->getRepository('transportBundle:Notification')->findAll();
        return $this->render('ligneTransport/notification.html.twig',array(
            'notifications'=>$notifications

            ));



    }





}

