<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function admin(){}

}
