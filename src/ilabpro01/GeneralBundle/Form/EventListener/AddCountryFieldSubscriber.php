<?php

namespace ilabpro01\GeneralBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;



class AddCountryFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPathToCity;
 
    public function __construct($propertyPathToCity)
    {
        $this->propertyPathToCity = $propertyPathToCity;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND   => 'preSubmit'
        );
    }
 
    private function addCountryForm($form, $pais = null)
    {
        $formOptions = array(
            'class'         => 'ilabpro01GeneralBundle:pais',
            'mapped'        => false,
            'label'         => 'País',
            'empty_value'   => 'País',
            'attr'          => array(
            'class' => 'country_selector',
            ),
        );
 
        if ($pais) {
            $formOptions['data'] = $pais;
        }
 
        $form->add('pais', 'entity', $formOptions);
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $accessor = PropertyAccess::getPropertyAccessor();
 
        $ciudad    = $accessor->getValue($data, $this->propertyPathToCity);
        $pais = ($ciudad) ? $ciudad->getProvincia()->getPais() : null;
 
        $this->addCountryForm($form, $pais);
    }
 
    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
 
        $this->addCountryForm($form);
    }
}
