<?php

namespace ilabpro01\GeneralBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity
 * @ORM\Table(name="PlanFotografo")
 * 
 * @DoctrineAssert\UniqueEntity(fields = "codigoPlan", message="El código ingresado ya existe para otro Plan.")
 * 
 */
class planFotografo {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit = 10, message = "El máximo número de caracteres es 10.")
     * 
     */
    protected $codigoPlan;
    
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $nombre;
    
    
    /**
     * @ORM\Column(type="integer", length=3)
     * @Assert\MaxLength(limit = 3, message = "El máximo número de dígitos es 3.")
     * 
     */
    protected $diasVigencia;
    
    
    /**
     * @ORM\Column(type="boolean", length=1, nullable=true)
     * 
     */
    protected $disponible;
    
    
    /**
     * @ORM\OneToMany(targetEntity="fotografo", mappedBy="planFotografo")
     */
    protected $fotografos;
    
    public function __construct() {
        
        $this->fotografos = new ArrayCollection();
    }
   
    
    public function __toString() {
        return $nom = $this->getNombre();
    }


     /**
     * Set id
     *
     * @param integer 
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigoPlan
     *
     * @param string $codigoPlan
     * @return planFotografo
     */
    public function setCodigoPlan($codigoPlan)
    {
        $this->codigoPlan = $codigoPlan;
    
        return $this;
    }

    /**
     * Get codigoPlan
     *
     * @return string 
     */
    public function getCodigoPlan()
    {
        return $this->codigoPlan;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return planFotografo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set diasVigencia
     *
     * @param integer $diasVigencia
     * @return planFotografo
     */
    public function setDiasVigencia($diasVigencia)
    {
        $this->diasVigencia = $diasVigencia;
    
        return $this;
    }

    /**
     * Get diasVigencia
     *
     * @return integer 
     */
    public function getDiasVigencia()
    {
        return $this->diasVigencia;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     * @return planFotografo
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    
        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean 
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Add fotografos
     *
     * @param \ilabpro01\GeneralBundle\Entity\fotografo $fotografos
     * @return planFotografo
     */
    public function addFotografo(\ilabpro01\GeneralBundle\Entity\fotografo $fotografos)
    {
        $this->fotografos[] = $fotografos;
    
        return $this;
    }

    /**
     * Remove fotografos
     *
     * @param \ilabpro01\GeneralBundle\Entity\fotografo $fotografos
     */
    public function removeFotografo(\ilabpro01\GeneralBundle\Entity\fotografo $fotografos)
    {
        $this->fotografos->removeElement($fotografos);
    }

    /**
     * Get fotografos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotografos()
    {
        return $this->fotografos;
    }
}