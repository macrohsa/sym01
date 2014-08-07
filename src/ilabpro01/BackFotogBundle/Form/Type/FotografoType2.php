<?php

namespace ilabpro01\BackFotogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use ilabpro01\GeneralBundle\Form\EventListener\AddCityFieldSubscriber;
use ilabpro01\GeneralBundle\Form\EventListener\AddProvinceFieldSubscriber;
use ilabpro01\GeneralBundle\Form\EventListener\AddCountryFieldSubscriber;

/*
 * Cuando el fotógrafo tiene un plan vigente
 * No se muestra combo para entidad Plan, se agrega en modifFotografo como cuadro de texto readonly
 */

class FotografoType2 extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $generador, array $opciones){
        
        $propertyPathToCity = 'ciudad';
        
        $generador->add('id','hidden', array(
        ));
        $generador->add('nombre','text', array(
            'label' =>'Nombre ',
            'max_length' =>50,
        ));
        $generador->add('apellido','text', array(
            'label' =>'Apellido ',
            'max_length' =>50,
        ));
        $generador->add('email','text', array(
            'label' =>'Email ',
            'max_length' =>50,
        ));
        $generador->add('usuario','text', array(
            'label' =>'Usuario ',
            'max_length' =>30,
        ));
        $generador->add('contrasenia','text', array(
            'label' =>'Contraseña ',
            'max_length' =>30,
        ));
        $generador->add('telefono','text', array(
            'label' =>'Teléfono ',
            'max_length' =>20,
        ));
        $generador->add('estudio','text', array(
            'label' =>'Estudio ',
            'max_length' =>50,
        ));
        $generador->add('calleEstudio','text', array(
            'label' =>'Calle Estudio',
            'max_length' =>50,
        ));
        $generador->add('numeroEstudio','text', array(
            'label' =>'Número Estudio',
            'max_length' =>50,
            'required' =>false,
        ));
        $generador->add('telefonoEstudio','text', array(
            'label' =>'Teléfono Estudio',
            'max_length' =>50,
            'required' =>false,
        ));
        $generador
                ->addEventSubscriber(new AddCountryFieldSubscriber($propertyPathToCity))
                ->addEventSubscriber(new AddProvinceFieldSubscriber($propertyPathToCity))
                ->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity))
        ;
        
    }
    
    
    public function getDefaultOptions(array $options) {
        return array('data_class' => 'ilabpro01\GeneralBundle\Entity\fotografo',);
    }
    
    
    public function getName() {
        return 'nombre';
    }
    
    
    
}
