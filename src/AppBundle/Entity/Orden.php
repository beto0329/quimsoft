<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orden
 *
 * @ORM\Table(name="orden")
 * @ORM\Entity
 */
class Orden
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_produccion", type="date", nullable=false)
     */
    private $fechaProduccion;

    /**
     * @var \string
     *
     * @ORM\Column(name="hora_produccion", type="string", length=10, nullable=false)
     */
    private $horaProduccion;

    /**
     * @var \string
     *
     * @ORM\Column(name="linea_produccion", type="string", length=100, nullable=false)
     */
    private $lineaProduccion;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUserInterpreta", referencedColumnName="id")
     * })
     */
    private $idUserInterpreta;
    
    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUserProduccion", referencedColumnName="id")
     * })
     */
    private $idUserProduccion;
    
    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUserCalidad", referencedColumnName="id")
     * })
     */
    private $idUserCalidad;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="current", type="date", nullable=false)
     */
    private $current;

    public function __construct()
    {
        $this->current = new \DateTime();
        $this->estado = false;
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
     * Set fechaProduccion
     *
     * @param string $fechaProduccion
     *
     * @return Orden
     */
    public function setFechaProduccion($fechaProduccion)
    {
        $this->fechaProduccion = $fechaProduccion;

        return $this;
    }

    /**
     * Get fechaProduccion
     *
     * @return string
     */
    public function getFechaProduccion()
    {
        return $this->fechaProduccion;
    }

    /**
     * Set horaProduccion
     *
     * @param string $horaProduccion
     *
     * @return Orden
     */
    public function setHoraProduccion($horaProduccion)
    {
        $this->horaProduccion = $horaProduccion;

        return $this;
    }

    /**
     * Get horaProduccion
     *
     * @return string
     */
    public function getHoraProduccion()
    {
        return $this->horaProduccion;
    }

    /**
     * Set lineaProduccion
     *
     * @param string $lineaProduccion
     *
     * @return Orden
     */
    public function setLineaProduccion($lineaProduccion)
    {
        $this->lineaProduccion = $lineaProduccion;

        return $this;
    }

    /**
     * Get lineaProduccion
     *
     * @return string
     */
    public function getLineaProduccion()
    {
        return $this->lineaProduccion;
    }
    
    /**
     * Set idUserInterpreta
     *
     * @param \AppBundle\Entity\User $idUserInterpreta
     *
     * @return User
     */
    public function setIdUserInterpreta(\AppBundle\Entity\User $idUserInterpreta = null)
    {
        $this->idUserInterpreta = $idUserInterpreta;

        return $this;
    }

    /**
     * Get idUserInterpreta
     *
     * @return \AppBundle\Entity\User
     */
    public function getIdUserInterpreta()
    {
        return $this->idUserInterpreta;
    }
    
    /**
     * Set idUserProduccion
     *
     * @param \AppBundle\Entity\User $idUserProduccion
     *
     * @return User
     */
    public function setIdUserProduccion(\AppBundle\Entity\User $idUserProduccion = null)
    {
        $this->idUserProduccion = $idUserProduccion;

        return $this;
    }

    /**
     * Get idUserProduccion
     *
     * @return \AppBundle\Entity\User
     */
    public function getIdUserProduccion()
    {
        return $this->idUserProduccion;
    }
    
    /**
     * Set idUserProduccion
     *
     * @param \AppBundle\Entity\User $idUserCalidad
     *
     * @return User
     */
    public function setIdUserCalidad(\AppBundle\Entity\User $idUserCalidad = null)
    {
        $this->idUserCalidad = $idUserCalidad;

        return $this;
    }

    /**
     * Get idUserCalidad
     *
     * @return \AppBundle\Entity\User
     */
    public function getIdUserCalidad()
    {
        return $this->idUserCalidad;
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

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Orden
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
}
