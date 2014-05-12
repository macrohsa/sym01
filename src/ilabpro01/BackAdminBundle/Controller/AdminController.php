<?php

namespace ilabpro01\BackAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class AdminController  extends Controller
{
    
    public function indexAction()
    {
        return $this->render('ilabpro01BackAdminBundle:Default:index.html.twig');
    }
    
    
    
    /**
     * Obtener el listado de todos los fotógrafos registrados en el sitio
     */
    public function listaFotografosAction(){
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $fotog = $em->getRepository('ilabpro01GeneralBundle:fotografo')->findAll();
        
        return $this->render('ilabpro01BackAdminBundle:Default:listadoFotografos.html.twig', array('fotografos' => $fotog));
    }
    
    
    
    /**
     * Obtener el listado de todos los planes de fotógrafos
     */
    public function listaPlanesAction(){
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $planFotog = $em->getRepository('ilabpro01GeneralBundle:planFotografo')->findAll();
         
        return $this->render('ilabpro01BackAdminBundle:Default:listadoPlanes.html.twig', array('planes' => $planFotog));
    }
    
    
    public function altaPlanFotografoAction(Request $request) {
        
        $planFotografo = new \ilabpro01\GeneralBundle\Entity\planFotografo();
         
        $form = $this->createForm(new \ilabpro01\BackAdminBundle\Form\Type\PlanType(), $planFotografo);
        
        if ($this->getRequest()->getMethod() == 'POST') {

            $form->bindRequest($this->getRequest());

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($planFotografo);
                $em->flush();
                
                $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:planFotografo');
                $planes = $repositorio->findAll();
                
                return $this->render('ilabpro01BackAdminBundle:Default:listadoPlanes.html.twig', array(
                    'planes' => $planes,
                ));
            }
        }
        
        return $this->render('ilabpro01BackAdminBundle:Default:altaPlan.html.twig', array(
            'form' => $form->createView(),
            ));
    }
    
    
    
    public function modificarPlanFotografoAction(Request $request) {
        
        $id = $_GET["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $planFotografo = $em->getRepository('ilabpro01GeneralBundle:planFotografo')->find($id);

        $form = $this->createForm(new \ilabpro01\BackAdminBundle\Form\Type\PlanType(), $planFotografo);
        
        if ($this->getRequest()->getMethod() == 'POST') {

            $form->bindRequest($this->getRequest());

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($planFotografo);
                $em->flush();
                
                $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:planFotografo');
                $planes = $repositorio->findAll();
                
                return $this->render('ilabpro01BackAdminBundle:Default:listadoPlanes.html.twig', array(
                    'planes' => $planes,
                ));
            }
        }
        
        return $this->render('ilabpro01BackAdminBundle:Default:modificarPlan.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
                ));
    }
    
    
     /**
     * Obtener el listado de todas las Formas de Pago de fotógrafos
     */
    public function listaFormasPagoAction(){
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $formaPagoFotog = $em->getRepository('ilabpro01GeneralBundle:formaPagoFotografo')->findAll();
        
        return $this->render('ilabpro01BackAdminBundle:Default:listadoFormasPago.html.twig', array('formasPago' => $formaPagoFotog));
    }
    
    
       
    public function altaFPagoFotografoAction(Request $request) {
        
        $formaPagoFotog = new \ilabpro01\GeneralBundle\Entity\formaPagoFotografo();
         
        $form = $this->createForm(new \ilabpro01\BackAdminBundle\Form\Type\FormaPagoType(), $formaPagoFotog);
        
        if ($this->getRequest()->getMethod() == 'POST') {
            
            $form->bindRequest($this->getRequest());

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($formaPagoFotog);
                $em->flush();
                
                $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:formaPagoFotografo');
                $formasPago = $repositorio->findAll();
                
                return $this->render('ilabpro01BackAdminBundle:Default:listadoFormasPago.html.twig', array(
                    'formasPago' => $formasPago,
                ));
            }
        }
        
        return $this->render('ilabpro01BackAdminBundle:Default:altaFormaPago.html.twig', array(
            'form' => $form->createView(),
            ));
    }
    
    
    
    public function modificarFPagoFotografoAction(Request $request) {
        
        
        $id = $_GET["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $formaPagoFotog = $em->getRepository('ilabpro01GeneralBundle:formaPagoFotografo')->find($id);
         
        $form = $this->createForm(new \ilabpro01\BackAdminBundle\Form\Type\FormaPagoType(), $formaPagoFotog);
        
        if ($this->getRequest()->getMethod() == 'POST') {
            
            $form->bindRequest($this->getRequest());

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($formaPagoFotog);
                $em->flush();
                
                $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:formaPagoFotografo');
                $formasPago = $repositorio->findAll();
                
                return $this->render('ilabpro01BackAdminBundle:Default:listadoFormasPago.html.twig', array(
                    'formasPago' => $formasPago,
                ));
            }
        }
        
        return $this->render('ilabpro01BackAdminBundle:Default:modificarFormaPago.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
                ));
    }
    
}