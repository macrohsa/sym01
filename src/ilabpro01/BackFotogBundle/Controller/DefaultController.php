<?php

namespace ilabpro01\BackFotogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ilabpro01BackFotogBundle:Default:index.html.twig', array('name' => $name));
    }
}
