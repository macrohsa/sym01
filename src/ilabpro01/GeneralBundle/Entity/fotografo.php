<?php

namespace ilabpro01\GeneralBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;


/**
 * @ORM\Entity
 * @ORM\Table(name="Fotografo")
 * 
 * @DoctrineAssert\UniqueEntity(fields = "email", message="El email ingresado corresponde a un usuario ya registrado.")
 * @DoctrineAssert\UniqueEntity(fields = "usuario", message="El usuario ingresado corresponde a un usuario ya registrado.")
 * 
 */
class fotografo {
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="sitio", inversedBy="fotografos")
     * @ORM\JoinColumn(name="sitio_id", referencedColumnName="id")
     */
    protected $sitio;
    
        
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "El nombre es obligatorio")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $nombre;
    
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "El apellido es obligatorio")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $apellido;
    
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "El email es obligatorio")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $email;
    
    
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message = "El usuario es obligatorio")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 30.")
     * 
     */
    protected $usuario;
    
    
    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message = "La contraseña es obligatoria")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 30.")
     * 
     */
    protected $contrasenia;
    
    

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message = "El teléfono es obligatorio")
     * @Assert\MaxLength(limit = 20, message = "El máximo número de caracteres es 20.")
     * 
     */
    protected $telefono;
    
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "El nombre del estudio es obligatorio")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $estudio;
    
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "La calle del estudio es obligatoria")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $calleEstudio;
    
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message = "El número del estudio es obligatorio")
     * @Assert\MaxLength(limit = 50, message = "El máximo número de caracteres es 50.")
     * 
     */
    protected $numeroEstudio;
    
    
    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message = "El teléfono del estudio es obligatorio")
     * @Assert\MaxLength(limit = 20, message = "El máximo número de caracteres es 20.")
     * 
     */
    protected $telefonoEstudio;
    
    
    /**
     * @ORM\Column(type="datetime")
     * 
     */
    protected $fechaAlta;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="ciudad", inversedBy="fotografos")
     * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id")
     */
    protected $ciudad;
    
    
    
    /**
     * @ORM\ManyToOne(targetEntity="planFotografo", inversedBy="fotografos")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     */
    protected $planFotografo;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="formaPagoFotografo", inversedBy="fotografos")
     * @ORM\JoinColumn(name="formaPago_id", referencedColumnName="id")
     */
    protected $formaPago;
    
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * 
     */
    protected $fechaInicioPlan;
    
    
    
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
     * Set nombre
     *
     * @param string $nombre
     * @return fotografo
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
     * Set apellido
     *
     * @param string $apellido
     * @return fotografo
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return fotografo
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return fotografo
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set contrasenia
     *
     * @param string $contrasenia
     * @return fotografo
     */
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    
        return $this;
    }

    /**
     * Get contrasenia
     *
     * @return string 
     */
    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return fotografo
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set estudio
     *
     * @param string $estudio
     * @return fotografo
     */
    public function setEstudio($estudio)
    {
        $this->estudio = $estudio;
    
        return $this;
    }

    /**
     * Get estudio
     *
     * @return string 
     */
    public function getEstudio()
    {
        return $this->estudio;
    }

    /**
     * Set calleEstudio
     *
     * @param string $calleEstudio
     * @return fotografo
     */
    public function setCalleEstudio($calleEstudio)
    {
        $this->calleEstudio = $calleEstudio;
    
        return $this;
    }

    /**
     * Get calleEstudio
     *
     * @return string 
     */
    public function getCalleEstudio()
    {
        return $this->calleEstudio;
    }

    /**
     * Set numeroEstudio
     *
     * @param string $numeroEstudio
     * @return fotografo
     */
    public function setNumeroEstudio($numeroEstudio)
    {
        $this->numeroEstudio = $numeroEstudio;
    
        return $this;
    }

    /**
     * Get numeroEstudio
     *
     * @return string 
     */
    public function getNumeroEstudio()
    {
        return $this->numeroEstudio;
    }

    /**
     * Set telefonoEstudio
     *
     * @param string $telefonoEstudio
     * @return fotografo
     */
    public function setTelefonoEstudio($telefonoEstudio)
    {
        $this->telefonoEstudio = $telefonoEstudio;
    
        return $this;
    }

    /**
     * Get telefonoEstudio
     *
     * @return string 
     */
    public function getTelefonoEstudio()
    {
        return $this->telefonoEstudio;
    }


    /**
     * Set ciudad
     *
     * @param \ilabpro01\GeneralBundle\Entity\ciudad $ciudad
     * @return fotografo
     */
    public function setCiudad(\ilabpro01\GeneralBundle\Entity\ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;
    
        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \ilabpro01\GeneralBundle\Entity\ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set planFotografo
     *
     * @param \ilabpro01\GeneralBundle\Entity\planFotografo $planFotografo
     * @return fotografo
     */
    public function setPlanFotografo(\ilabpro01\GeneralBundle\Entity\planFotografo $planFotografo = null)
    {
        $this->planFotografo = $planFotografo;
    
        return $this;
    }

    /**
     * Get planFotografo
     *
     * @return \ilabpro01\GeneralBundle\Entity\planFotografo 
     */
    public function getPlanFotografo()
    {
        return $this->planFotografo;
    }
    
    
    /**
     * Set formaPago
     *
     * @param \ilabpro01\GeneralBundle\Entity\formaPagoFotografo $formaPago
     * @return fotografo
     */
    public function setFormaPago(\ilabpro01\GeneralBundle\Entity\formaPagoFotografo $formaPago = null)
    {
        $this->formaPagoFotografo = $formaPago;
    
        return $this;
    }

    /**
     * Get formaPagoFotografo
     *
     * @return \ilabpro01\GeneralBundle\Entity\formaPagoFotografo 
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }


    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return fotografo
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    
        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }





    /**
     * Set fechaInicioPlan
     *
     * @param \DateTime $fechaInicioPlan
     * @return fotografo
     */
    public function setFechaInicioPlan($fechaInicioPlan)
    {
        $this->fechaInicioPlan = $fechaInicioPlan;
    
        return $this;
    }

    /**
     * Get fechaInicioPlan
     *
     * @return \DateTime 
     */
    public function getFechaInicioPlan()
    {
        return $this->fechaInicioPlan;
    }


    /**
     * Set sitio
     *
     * @param \ilabpro01\GeneralBundle\Entity\sitio $sitio
     * @return fotografo
     */
    public function setSitio(\ilabpro01\GeneralBundle\Entity\sitio $sitio = null)
    {
        $this->sitio = $sitio;
    
        return $this;
    }

    /**
     * Get sitio
     *
     * @return \ilabpro01\GeneralBundle\Entity\sitio 
     */
    public function getSitio()
    {
        return $this->sitio;
    }



}