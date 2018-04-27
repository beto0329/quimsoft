<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Laboratorio
 *
 * @ORM\Table(name="laboratorio")
 * @ORM\Entity
 */
class Laboratorio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=200, nullable=false)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="telContacto", type="string", length=20, nullable=false)
     */
    private $telcontacto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="current", type="date", nullable=false)
     */
    private $current;

    public function __construct()
    {
        $this->current = new \DateTime();
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
     *
     * @return Laboratorio
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
     * Set contacto
     *
     * @param string $contacto
     *
     * @return Laboratorio
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set telcontacto
     *
     * @param string $telcontacto
     *
     * @return Laboratorio
     */
    public function setTelcontacto($telcontacto)
    {
        $this->telcontacto = $telcontacto;

        return $this;
    }

    /**
     * Get telcontacto
     *
     * @return string
     */
    public function getTelcontacto()
    {
        return $this->telcontacto;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     *
     * @return Laboratorio
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return \DateTime
     */
    public function getCurrent()
    {
        return $this->current;
    }
}
