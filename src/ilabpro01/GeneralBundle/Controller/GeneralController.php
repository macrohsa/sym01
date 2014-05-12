<?php

namespace ilabpro01\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GeneralController extends Controller
{
    public function indexAction()
    {
        
        
        $repositorio = $this->getDoctrine()->getRepository('ilabpro01GeneralBundle:pais');
         
         $paises = $repositorio->findAll();
         
         
         return $this->render('ilabpro01GeneralBundle:Default:index.html.twig', array(
                    'paises' => $paises,
                ));
         
//        return $this->render('ilabpro01GeneralBundle:Default:index.html.twig');
    }
    
    
    public function getPaises(){
         

         
//         $items = array();
//    if($paises && 
//       mysql_num_rows($paises)>0) {
//        while($row = mysql_fetch_array($paises)) {
//            $option = array("id" => $row[0], "value" => htmlentities($row[1]));
//            $items[] = $option; 
//        }        
//    }
//    $data = json_encode($items); 
//    // Convertimos en formato JSON, luego imprimimos la data
//    $response = isset($_GET['callback'])?$_GET['callback']."(".$data.")":$data; 
//    echo($response);   

         
         
    }
    
    
}

