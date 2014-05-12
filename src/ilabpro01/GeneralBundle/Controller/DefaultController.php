<?php

namespace ilabpro01\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ilabpro01GeneralBundle:Default:index.html.twig', array('name' => $name));
    }
}
