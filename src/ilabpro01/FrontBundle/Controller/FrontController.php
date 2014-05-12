<?php

namespace ilabpro01\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController  extends Controller
{
    
    public function indexAction()
    {
        return $this->render('ilabpro01FrontBundle:Default:index.html.twig');
    }
}
