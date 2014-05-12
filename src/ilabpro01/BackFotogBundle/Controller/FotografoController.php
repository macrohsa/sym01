<?php

namespace ilabpro01\BackFotogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use DateTime;



class FotografoController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('ilabpro01BackFotogBundle:Default:loginFotografo.html.twig');
    }
    

   
    /*
     * Comprueba usuario y contraseña para Login
     */
    public function buscarUsuarioFotografoAction(Request $request){
        
        $errors='';
        $usuario =  $request->query->get('usuario');
        $contrasenia = $request->query->get('contrasenia');
        
        $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:fotografo');
        
        $fotografo = $repositorio->findOneBy(
                array('usuario' => $usuario, 'contrasenia' => $contrasenia)
                );
        
        if(!$fotografo){

           echo'<script type="text/javascript">
                alert("Usuario o Contraseña Incorrecta");
                window.location="http://localhost/Project01/web/app_dev.php/fotog/hello"
                </script>';
            

        }  else {
            $id = $fotografo->getId();
            
            $planVigente = $this-> obtenerVigencia($id);
            
            return $this->render('ilabpro01BackFotogBundle:Default:backFotografo.html.twig', array(
                    'id' => $id,
                'planvigente' => $planVigente,
                ));
        }
        
    }
    
    
    /*
     * Alta nuevo fotografo
     */
    public function nuevoFotografoAction(Request $request){
        
         $fotografo = new \ilabpro01\GeneralBundle\Entity\fotografo();
         

        $form = $this->createForm(new \ilabpro01\BackFotogBundle\Form\Type\FotografoType(), $fotografo);
        
        if ($this->getRequest()->getMethod() == 'POST') {
            

            $form->bindRequest($this->getRequest());

            
            if ($form->isValid()) {
                
                $hoy = new DateTime('NOW');
                $fotografo->setFechaAlta($hoy);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($fotografo);
                $em->flush();
                $email1 = $fotografo->getEmail();
                
                $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:fotografo');
                $fotog = $repositorio->findOneByEmail($email1);
                $id = $fotog->getId();
                
                return $this->render('ilabpro01BackFotogBundle:Default:backFotografo.html.twig', array(
                    'email1' => $email1,
                    'id' => $id,
                    'planvigente' => FALSE,
                ));
            }
        }
        
        return $this->render('ilabpro01BackFotogBundle:Default:altaFotografo.html.twig', array(
            'form' => $form->createView(),
            ));
    }

    /*
     * Almacenar datos fotografo existente
     */
    public function modificarFotografoAction(){
        
        
        $id = $_GET["id"];
        
        $planVigente = $this-> obtenerVigencia($id);
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $fotog = $em->getRepository('ilabpro01GeneralBundle:fotografo')->find($id);
        
        $form = $this->createForm(new \ilabpro01\BackFotogBundle\Form\Type\FotografoType(), $fotog);
        
          if ($this->getRequest()->getMethod() == 'POST') {
            
            $form->bindRequest($this->getRequest());
       
            if ($form->isValid()) {

                $em->flush();

                return $this->render('ilabpro01BackFotogBundle:Default:backFotografo.html.twig', array(
                    'id' => $id,
                    'planvigente' => $planVigente,
                ));
            }
        }
        
        return $this->render('ilabpro01BackFotogBundle:Default:modifFotografo.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
                ));
        
    }
    
    
    public function backFotografoAction(){
        
        
        
        $id = $_GET["id"];
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $fotog = $em->getRepository('ilabpro01GeneralBundle:fotografo')->find($id);
        
        $planVigente = $this-> obtenerVigencia($id);
               
         return $this->render('ilabpro01BackFotogBundle:Default:backFotografo.html.twig', array(
             'id'   => $id,
             'planvigente' => $planVigente,
                ));
    }
    
    
    public function obtenerVigencia($idFotografo){
        
        
        $planVigente = TRUE;
        $hoy = new DateTime('NOW');
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $fotog = $em->getRepository('ilabpro01GeneralBundle:fotografo')->find($idFotografo);
        
        $fechaInicio = $fotog->getFechaInicioPlan();
        
        if($fechaInicio){
            
            $diasTranscurridos = $fechaInicio->diff($hoy);

            $diastr = (int)$diasTranscurridos->format("%r%a");
            
            $planSeleccionado = $fotog->getPlanFotografo();
            $diasVigenciaPlan = $planSeleccionado->getDiasVigencia();
            
            if($diastr > $diasVigenciaPlan){
                $planVigente = FALSE;
            }
        }else{
            $planVigente = FALSE;
        }
        
        return $planVigente;
        
    }




    /*
     * Mostrar datos fotografo
     */
    public function mostrarDatosFotografoAction($fotografo){
        
    }
    

/**
 * @Route("/provinces", name="select_provinces")
 */
    public function provincesAction(Request $request)
    {
        $pais_id = $request->request->get('country_id');

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT ma FROM ilabpro01GeneralBundle:provincia ma WHERE ma.pais= :pais')->setParameter('pais',$pais_id);
        $myArray = $query->getArrayResult();
        
        return new JsonResponse($myArray);
    }

/**
 * @Route("/cities", name="select_cities")
 */
    public function citiesAction(Request $request)
    {
        $provincia_id = $request->request->get('province_id');

        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery('SELECT ma FROM ilabpro01GeneralBundle:ciudad ma WHERE ma.provincia= :provincia')->setParameter('provincia',$provincia_id);
        $myArray = $query->getArrayResult();

        return new JsonResponse($myArray);
    }
    

 
    /*
     * Almacenar datos del plan de un fotografo existente
     */
    public function pagoPlanFotografoAction(){
        

        $id = $_GET["id"];
        
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $fotog = $em->getRepository('ilabpro01GeneralBundle:fotografo')->find($id);
        
        $form = $this->createForm(new \ilabpro01\BackFotogBundle\Form\Type\FormaPagoFotografoType(), $fotog);

        
          if ($this->getRequest()->getMethod() == 'POST') {
            
            $form->bindRequest($this->getRequest());
            
            if ($form->isValid()) {
                
                $fotog->setFechaInicioPlan($hoy);
                
                $planVigente = $this-> obtenerVigencia($id);                

                $em->flush();

                return $this->render('ilabpro01BackFotogBundle:Default:backFotografo.html.twig', array(
                    'id' => $id,
                    'planvigente' => TRUE,
                ));
            }
        }
        
        return $this->render('ilabpro01BackFotogBundle:Default:formaPagoFotografo.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
                ));
        
    }
    
    
    
}
