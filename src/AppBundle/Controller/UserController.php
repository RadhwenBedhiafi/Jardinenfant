<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends  Controller
{

    public function redirectAction()
    {
        $authChecker= $this->container->get('security.authorization_checker') ;
        if($authChecker->isGranted('ROLE_ADMIN')){

            return $this->render('baseBack.html.twig');
        }
        elseif ($authChecker->isGranted('ROLE_USER')){
            return $this->render('base.html.twig');
        }
        else{
            return $this->render('@FOSUser/security/login.html.twig');

        }
    }

}