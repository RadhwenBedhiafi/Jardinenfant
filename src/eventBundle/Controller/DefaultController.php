<?php

namespace eventBundle\Controller;

use eventBundle\Form\evennementsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
    }
    public function  participerAction($id){

    }
    public function frontAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('eventBundle:evennements')->findAll();
        $ev = end($events);

        return $this->render('@event/Default/indexfront.html.twig', array(
            'l' => $ev
        ));
    }
    public function eventAction(){
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('eventBundle:evennements')->findAll();
        return $this->render('@event/Default/listevent.html.twig', array(
            'events' => $events
        ));
    }

    public function ratingAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('eventBundle:evennements')->find($id);
        $form = $this->createForm(evennementsType::class,$events);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->flush();
            //return $this->redirectToRoute('event_homepage');
        }
        return $this->render('@event/Default/rating.html.twig', array(
            'f' => $form->createView()
        ));
    }
}
