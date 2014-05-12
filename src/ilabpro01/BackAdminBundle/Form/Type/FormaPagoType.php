<?php


namespace ilabpro01\BackAdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class FormaPagoType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $generador, array $opciones){
        
        $generador->add('id','hidden', array(
        ));
        $generador->add('codigoFormaPago','text', array(
            'label' =>'Código ',
            'max_length' =>10,
        ));
        $generador->add('nombre','text', array(
            'label' =>'Nombre ',
            'max_length' =>50,
        ));
        $generador->add('disponible','checkbox', array(
            'label' =>'Disponible ',
            'required' =>false,
        ));


    }
    
    public function getDefaultOptions(array $options) {
        return array('data_class' => 'ilabpro01\GeneralBundle\Entity\formaPagoFotografo',);
    }
    
    
    public function getName() {
        return 'nombre';
    }
}
