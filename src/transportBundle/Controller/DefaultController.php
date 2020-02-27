<?php

namespace transportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use transportBundle\Entity\ligneTransport;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@transport/Default/index.html.twig');
    }





//    public function searchAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $requestString = $request->get('l');
//        $ligneTransport =  $em->getRepository('transportBundle:ligneTransport')->findEntitiesByString($requestString);
//        if(!$ligneTransport) {
//            $result['ligneTransport']['error'] = "ligne Not found :( ";
//        } else {
//            $result['ligneTransport'] = $this->getRealEntities($ligneTransport);
//        }
//        return new Response(json_encode($result));
//    }










}
