<?php

namespace ilabpro01\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Provincia")
 * 
 */
class provincia {
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
     * @ORM\ManyToOne(targetEntity="pais", inversedBy="provincias")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     */
    protected $pais;
    
    
     /**
     * @ORM\OneToMany(targetEntity="fotografo", mappedBy="provincia")
     */
    protected $fotografos;
    
    
    /**
     * @ORM\OneToMany(targetEntity="ciudad", mappedBy="provincia")
     */
    protected $ciudades;
    
    
    
    public function __construct() {
        $this->ciudades = new ArrayCollection();
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
     * @return provincia
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
     * Set pais
     *
     * @param \ilabpro01\GeneralBundle\Entity\pais $pais
     * @return provincia
     */
    public function setPais(\ilabpro01\GeneralBundle\Entity\pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return \ilabpro01\GeneralBundle\Entity\pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add fotografos
     *
     * @param \ilabpro01\GeneralBundle\Entity\fotografo $fotografos
     * @return provincia
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

    /**
     * Add ciudades
     *
     * @param \ilabpro01\GeneralBundle\Entity\ciudad $ciudades
     * @return provincia
     */
    public function addCiudade(\ilabpro01\GeneralBundle\Entity\ciudad $ciudades)
    {
        $this->ciudades[] = $ciudades;
    
        return $this;
    }

    /**
     * Remove ciudades
     *
     * @param \ilabpro01\GeneralBundle\Entity\ciudad $ciudades
     */
    public function removeCiudade(\ilabpro01\GeneralBundle\Entity\ciudad $ciudades)
    {
        $this->ciudades->removeElement($ciudades);
    }

    /**
     * Get ciudades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCiudades()
    {
        return $this->ciudades;
    }
}