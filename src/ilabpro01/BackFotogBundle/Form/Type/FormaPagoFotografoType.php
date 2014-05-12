<?php

namespace ilabpro01\BackFotogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;



class FormaPagoFotografoType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $generador, array $opciones){

        $generador->add('id','hidden', array(
        ));
         $generador->add('formaPago','entity', array(
            'label' =>'Forma Pago',
            'empty_value'   => 'Forma Pago',
            'class' => 'ilabpro01\GeneralBundle\Entity\formaPagoFotografo',
            'required' =>true,
             'query_builder' => function(EntityRepository $er){
             return $er->createQueryBuilder('p')
                     ->where('p.disponible = 1');
             }
        ));
      
        
    }
    
    
    public function getDefaultOptions(array $options) {
        return array('data_class' => 'ilabpro01\GeneralBundle\Entity\fotografo',);
    }
    
    
    public function getName() {
        return 'nombre';
    }

}
