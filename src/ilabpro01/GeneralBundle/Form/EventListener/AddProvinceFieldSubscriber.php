<?php

namespace ilabpro01\GeneralBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use ilabpro01\GeneralBundle\Entity\pais;


class AddProvinceFieldSubscriber implements EventSubscriberInterface
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
 
    
    private function addProvinceForm($form, $pais_id, $provincia = null)
    {
        $formOptions = array(
            'class'         => 'ilabpro01GeneralBundle:provincia',
            'empty_value'   => 'Provincia',
            'label'         => 'Provincia',
            'mapped'        => false,
            'attr'          => array(
            'class' => 'province_selector',
            ),
            'query_builder' => function (EntityRepository $repository) use ($pais_id) {
                $qb = $repository->createQueryBuilder('provincia')
                    ->innerJoin('provincia.pais', 'pais')
                    ->where('pais.id = :pais')
                    ->setParameter('pais', $pais_id)
                ;
 
                return $qb;
            }
        );
 
        if ($provincia) {
            $formOptions['data'] = $provincia;
        }
 
        $form->add('provincia','entity', $formOptions);
    }
 
    
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $accessor = PropertyAccess::getPropertyAccessor();
 
        $ciudad        = $accessor->getValue($data, $this->propertyPathToCity);
        $provincia    = ($ciudad) ? $ciudad->getProvincia() : null;
        $pais_id  = ($provincia) ? $provincia->getPais()->getId() : null;
 
        $this->addProvinceForm($form, $pais_id, $provincia);
    }
 
    
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        $pais_id = array_key_exists('pais', $data) ? $data['pais'] : null;
 
        $this->addProvinceForm($form, $pais_id);
    }
    
    
}