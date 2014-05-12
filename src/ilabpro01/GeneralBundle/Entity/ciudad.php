<?php

namespace ilabpro01\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Ciudad")
 * 
 */
class ciudad {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;
    
        
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message = "El nombre es obligatorio")
     * @Assert\MaxLength(limit = 100, message = "El máximo número de caracteres es 100.")
     * 
     */
    protected $nombre;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="provincia", inversedBy="ciudades")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    protected $provincia;
    
    
    /**
     * @ORM\OneToMany(targetEntity="fotografo", mappedBy="ciudad")
     */
    protected $fotografos;
    
    
    
    public function __construct() {
        $this->fotografos = new ArrayCollection();
    }
    
    
    public function __toString() {
        return $nom = $this->getNombre();
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
     * Set nombre
     *
     * @param string $nombre
     * @return ciudad
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
     * Set provincia
     *
     * @param \ilabpro01\GeneralBundle\Entity\provincia $provincia
     * @return ciudad
     */
    public function setProvincia(\ilabpro01\GeneralBundle\Entity\provincia $provincia = null)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return \ilabpro01\GeneralBundle\Entity\provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Add fotografos
     *
     * @param \ilabpro01\GeneralBundle\Entity\fotografo $fotografos
     * @return ciudad
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