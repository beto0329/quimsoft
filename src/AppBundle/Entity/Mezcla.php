<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mezcla
 *
 * @ORM\Table(name="mezcla")
 * @ORM\Entity
 */
class Mezcla
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
     * @var \Orden
     *
     * @ORM\ManyToOne(targetEntity="Orden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idOrden", referencedColumnName="id")
     * })
     */
    private $idorden;
    
    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPaciente", referencedColumnName="id")
     * })
     */
    private $idpaciente;
    
    /**
     * @var \Guiaestabilidad
     *
     * @ORM\ManyToOne(targetEntity="Guiaestabilidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGuiaestabilidad", referencedColumnName="id")
     * })
     */
    private $idguiaestabilidad;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="dosis", type="string", length=10, nullable=false)
     */
    private $dosis;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="diagnostico", type="text", nullable=true)
     */
    private $diagnostico;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="eps", type="string", length=100, nullable=true)
     */
    private $eps;
    


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
     * Set idorden
     *
     * @param \AppBundle\Entity\Orden $idorden
     *
     * @return Mezcla
     */
    public function setIdorden(\AppBundle\Entity\Orden $idorden = null)
    {
        $this->idorden = $idorden;

        return $this;
    }

    /**
     * Get $idorden
     *
     * @return \AppBundle\Entity\Orden
     */
    public function getIdorden()
    {
        return $this->idorden;
    }
    
    /**
     * Set idpaciente
     *
     * @param \AppBundle\Entity\Paciente $idpaciente
     *
     * @return Mezcla
     */
    public function setIdpaciente(\AppBundle\Entity\Paciente $idpaciente = null)
    {
        $this->idpaciente = $idpaciente;

        return $this;
    }

    /**
     * Get $idpaciente
     *
     * @return \AppBundle\Entity\Paciente
     */
    public function getIdpaciente()
    {
        return $this->idpaciente;
    }
    
    /**
     * Set idguiaestabilidad
     *
     * @param \AppBundle\Entity\Guiaestabilidad $idguiaestabilidad
     *
     * @return Mezcla
     */
    public function setIdguiaestabilidad(\AppBundle\Entity\Guiaestabilidad $idguiaestabilidad = null)
    {
        $this->idguiaestabilidad = $idguiaestabilidad;

        return $this;
    }

    /**
     * Get $idguiaestabilidad
     *
     * @return \AppBundle\Entity\Guiaestabilidad
     */
    public function getIdguiaestabilidad()
    {
        return $this->idguiaestabilidad;
    }
    
    /**
     * Set dosis
     *
     * @param string $dosis
     *
     * @return Mezcla
     */
    public function setDosis($dosis)
    {
        $this->dosis = $dosis;

        return $this;
    }

    /**
     * Get dosis
     *
     * @return string
     */
    public function getDosis()
    {
        return $this->dosis;
    }
    
    /**
     * Set diagnostico
     *
     * @param string $diagnostico
     *
     * @return Mezcla
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return string
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }
    
    /**
     * Set eps
     *
     * @param string $eps
     *
     * @return Mezcla
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
    
}