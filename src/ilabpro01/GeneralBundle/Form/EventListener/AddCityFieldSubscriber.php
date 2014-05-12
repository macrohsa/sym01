<?php

namespace ilabpro01\GeneralBundle\Form\EventListener;
 
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use ilabpro01\GeneralBundle\Entity\provincia;
use ilabpro01\GeneralBundle\Entity\ciudad;


class AddCityFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPathToCity;
 
    public function __construct($propertyPathToCity)
    {
        $this->propertyPathToCity = $propertyPathToCity;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::POST_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND    => 'preSubmit'
        );
    }
 
    private function addCityForm($form, $provincia_id)
    {
        $formOptions = array(
            'class'         => 'ilabpro01GeneralBundle:ciudad',
            'empty_value'   => 'Ciudad',
            'label'         => 'Ciudad',
            'attr'          => array(
            'class' => 'city_selector',
            ),
            'query_builder' => function (EntityRepository $repository) use ($provincia_id) {
                $qb = $repository->createQueryBuilder('ciudad')
                    ->innerJoin('ciudad.provincia', 'provincia')
                    ->where('provincia.id = :provincia')
                    ->setParameter('provincia', $provincia_id)
                ;
 
                return $qb;
            }
        );
 
        $form->add($this->propertyPathToCity, 'entity', $formOptions);
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $accessor    = PropertyAccess::getPropertyAccessor();
 
        $ciudad        = $accessor->getValue($data, $this->propertyPathToCity);
        $provincia_id = ($ciudad) ? $ciudad->getProvincia()->getId() : null;
 
        $this->addCityForm($form, $provincia_id);
    }
 
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        $provincia_id = array_key_exists('provincia', $data) ? $data['provincia'] : null;
 
        $this->addCityForm($form, $provincia_id);
    }
}