<?php

namespace ilabpro01\GeneralBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Pais")
 * 
 */
class pais {
    
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
     * @ORM\OneToMany(targetEntity="provincia", mappedBy="pais")
     */
    protected $provincias;
    
    

    /**
     * @ORM\OneToMany(targetEntity="fotografo", mappedBy="pais")
     */
    protected $fotografos;
    
    
    
    public function __construct() {
        $this->provincias = new ArrayCollection();
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
     * @return pais
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
     * Add provincias
     *
     * @param \ilabpro01\GeneralBundle\Entity\provincia $provincias
     * @return pais
     */
    public function addProvincia(\ilabpro01\GeneralBundle\Entity\provincia $provincias)
    {
        $this->provincias[] = $provincias;
    
        return $this;
    }

    /**
     * Remove provincias
     *
     * @param \ilabpro01\GeneralBundle\Entity\provincia $provincias
     */
    public function removeProvincia(\ilabpro01\GeneralBundle\Entity\provincia $provincias)
    {
        $this->provincias->removeElement($provincias);
    }

    /**
     * Get provincias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProvincias()
    {
        return $this->provincias;
    }

    /**
     * Add fotografos
     *
     * @param \ilabpro01\GeneralBundle\Entity\fotografo $fotografos
     * @return pais
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