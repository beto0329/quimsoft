<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity
 */
class Paciente
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
     * @ORM\Column(name="nombre_completo", type="string", length=250, nullable=false)
     */
    private $nombreCompleto;

    /**
     * @var string
     *
     * @ORM\Column(name="eps", type="string", length=150)
     */
    private $eps;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico", type="text")
     */
    private $diagnostico;

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
     * Set nombreCompleto
     *
     * @param string $nombreCompleto
     *
     * @return Medicamento
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }

    /**
     * Get nombreCompleto
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Set eps
     *
     * @param string $eps
     *
     * @return Medicamento
     */
    public function setEps($eps)
    {
        $this->eps = $eps;

        return $this;
    }

    /**
     * Get eps
     *
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Set diagnostico
     *
     * @param \DateTime $diagnostico
     *
     * @return Medicamento
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return \DateTime
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
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
