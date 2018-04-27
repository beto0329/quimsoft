<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamento
 *
 * @ORM\Table(name="medicamento")
 * @ORM\Entity
 */
class Medicamento
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
     * @ORM\Column(name="nombre_medicamento", type="string", length=150, nullable=false)
     */
    private $nombreMedicamento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="presentacion_existencia", type="string", length=150, nullable=false)
     */
    private $presentacionExistencia;

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

    /**
     * @var \Laboratorio
     *
     * @ORM\ManyToOne(targetEntity="Laboratorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLaboratorio", referencedColumnName="id")
     * })
     */
    private $idlaboratorio;
    
    
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
     * Set nombreMedicamento
     *
     * @param string $nombreMedicamento
     *
     * @return Medicamento
     */
    public function setNombreMedicamento($nombreMedicamento)
    {
        $this->nombreMedicamento = $nombreMedicamento;

        return $this;
    }

    /**
     * Get nombreMedicamento
     *
     * @return string
     */
    public function getNombreMedicamento()
    {
        return $this->nombreMedicamento;
    }
    
    /**
     * Set presentacionExistencia
     *
     * @param string $presentacionExistencia
     *
     * @return Medicamento
     */
    public function setPresentacionExistencia($presentacionExistencia)
    {
        $this->presentacionExistencia = $presentacionExistencia;

        return $this;
    }

    /**
     * Get presentacionExistencia
     *
     * @return string
     */
    public function getPresentacionExistencia()
    {
        return $this->presentacionExistencia;
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
    
    /**
     * Set idlaboratorio
     *
     * @param \AppBundle\Entity\Laboratorio $idlaboratorio
     *
     * @return Guiaestabilidad
     */
    public function setIdlaboratorio(\AppBundle\Entity\Laboratorio $idlaboratorio = null)
    {
        $this->idlaboratorio = $idlaboratorio;

        return $this;
    }

    /**
     * Get idlaboratorio
     *
     * @return \AppBundle\Entity\Laboratorio
     */
    public function getIdlaboratorio()
    {
        return $this->idlaboratorio;
    }
}
