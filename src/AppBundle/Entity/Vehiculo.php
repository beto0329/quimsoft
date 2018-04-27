<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehiculo
 *
 * @ORM\Table(name="vehiculo")
 * @ORM\Entity
 */
class Vehiculo
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
     * @ORM\Column(name="nombre_vehiculo", type="string", length=150, nullable=false)
     */
    private $nombreVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="lote", type="string", length=50, nullable=false)
     */
    private $lote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=false)
     */
    private $fechaVencimiento;

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
     * Set nombreVehiculo
     *
     * @param string $nombreVehiculo
     *
     * @return Medicamento
     */
    public function setNombreVehiculo($nombreVehiculo)
    {
        $this->nombreVehiculo = $nombreVehiculo;

        return $this;
    }

    /**
     * Get nombreVehiculo
     *
     * @return string
     */
    public function getNombreVehiculo()
    {
        return $this->nombreVehiculo;
    }

    /**
     * Set lote
     *
     * @param string $lote
     *
     * @return Medicamento
     */
    public function setLote($lote)
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * Get lote
     *
     * @return string
     */
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     *
     * @return Medicamento
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;

        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     *
     * @return Medicamento
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
