<?php

namespace eventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    }

    public function frontAction()
    {
        return $this->render('@event/Default/indexfront.html.twig');
    }
    public function eventAction(){
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('eventBundle:evennements')->findAll();
        return $this->render('@event/Default/listevent.html.twig', array(
            'events' => $events
        ));
    }
}
