<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guiaestabilidad
 *
 * @ORM\Table(name="guiaestabilidad", indexes={@ORM\Index(name="IDX_879BEF3ADD6092AE", columns={"idLaboratorio"})})
 * @ORM\Entity
 */
class Guiaestabilidad
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
     * @ORM\Column(name="nombreLasa", type="string", length=150, nullable=false)
     */
    private $nombrelasa;

    /**
     * @var float
     *
     * @ORM\Column(name="presentacionFavorita", type="float", precision=10, scale=0, nullable=false)
     */
    private $presentacionfavorita;

    /**
     * @var string
     *
     * @ORM\Column(name="unidadMediad", type="string", length=20, nullable=false)
     */
    private $unidadmediad;

    /**
     * @var float
     *
     * @ORM\Column(name="volReconstitucion", type="float", precision=10, scale=0, nullable=false)
     */
    private $volreconstitucion;

    /**
     * @var float
     *
     * @ORM\Column(name="concentracion", type="float", precision=10, scale=0, nullable=false)
     */
    private $concentracion;

    /**
     * @var string
     *
     * @ORM\Column(name="envase", type="string", length=100, nullable=false)
     */
    private $envase;

    /**
     * @var string
     *
     * @ORM\Column(name="vehiculoDilucion", type="string", length=100, nullable=false)
     */
    private $vehiculodilucion;

    /**
     * @var float
     *
     * @ORM\Column(name="volVehiculoDilucion", type="float", precision=10, scale=0, nullable=false)
     */
    private $volvehiculodilucion;

    /**
     * @var string
     *
     * @ORM\Column(name="viaAdmon", type="string", length=50, nullable=false)
     */
    private $viaadmon;

    /**
     * @var string
     *
     * @ORM\Column(name="condicionesAlmacenamiento", type="string", length=150, nullable=false)
     */
    private $condicionesalmacenamiento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fotosensible", type="boolean", nullable=false)
     */
    private $fotosensible;

    /**
     * @var float
     *
     * @ORM\Column(name="estabilidadMezclaDias", type="float", precision=10, scale=0, nullable=false)
     */
    private $estabilidadmezcladias;

    /**
     * @var float
     *
     * @ORM\Column(name="estabilidadMezclaHoras", type="float", precision=10, scale=0, nullable=false)
     */
    private $estabilidadmezclahoras;

    /**
     * @var float
     *
     * @ORM\Column(name="estabilidadSobranteDias", type="float", precision=10, scale=0, nullable=false)
     */
    private $estabilidadsobrantedias;

    /**
     * @var float
     *
     * @ORM\Column(name="estabilidadSobranteHoras", type="float", precision=10, scale=0, nullable=false)
     */
    private $estabilidadsobrantehoras;

    /**
     * @var string
     *
     * @ORM\Column(name="condiAlmacenSobrante", type="string", length=150, nullable=false)
     */
    private $condialmacensobrante;

    /**
     * @var string
     *
     * @ORM\Column(name="grupoTerapeutico", type="string", length=150, nullable=false)
     */
    private $grupoterapeutico;

    /**
     * @var string
     *
     * @ORM\Column(name="ordenCampana", type="string", length=10, nullable=false)
     */
    private $ordencampana;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=150, nullable=false)
     */
    private $referencia;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempoInfusion", type="string", length=150, nullable=false)
     */
    private $tiempoinfusion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=150, nullable=false)
     */
    private $tipo;

    /**
     * @var \Laboratorio
     *
     * @ORM\ManyToOne(targetEntity="Laboratorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLaboratorio", referencedColumnName="id")
     * })
     */
    private $idlaboratorio;
    
    /**
     * @var \Medicamento
     *
     * @ORM\ManyToOne(targetEntity="Medicamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMedicamento", referencedColumnName="id")
     * })
     */
    private $idmedicamento;
    
    /**
     * @var \LineaProduccion
     *
     * @ORM\ManyToOne(targetEntity="LineaProduccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLineaProduccion", referencedColumnName="id", nullable=true)
     * })
     */
    private $idLineaProduccion;



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
     * Set nombrelasa
     *
     * @param string $nombrelasa
     *
     * @return Guiaestabilidad
     */
    public function setNombrelasa($nombrelasa)
    {
        $this->nombrelasa = $nombrelasa;

        return $this;
    }

    /**
     * Get nombrelasa
     *
     * @return string
     */
    public function getNombrelasa()
    {
        return $this->nombrelasa;
    }

    /**
     * Set presentacionfavorita
     *
     * @param float $presentacionfavorita
     *
     * @return Guiaestabilidad
     */
    public function setPresentacionfavorita($presentacionfavorita)
    {
        $this->presentacionfavorita = $presentacionfavorita;

        return $this;
    }

    /**
     * Get presentacionfavorita
     *
     * @return float
     */
    public function getPresentacionfavorita()
    {
        return $this->presentacionfavorita;
    }

    /**
     * Set unidadmediad
     *
     * @param string $unidadmediad
     *
     * @return Guiaestabilidad
     */
    public function setUnidadmediad($unidadmediad)
    {
        $this->unidadmediad = $unidadmediad;

        return $this;
    }

    /**
     * Get unidadmediad
     *
     * @return string
     */
    public function getUnidadmediad()
    {
        return $this->unidadmediad;
    }

    /**
     * Set volreconstitucion
     *
     * @param float $volreconstitucion
     *
     * @return Guiaestabilidad
     */
    public function setVolreconstitucion($volreconstitucion)
    {
        $this->volreconstitucion = $volreconstitucion;

        return $this;
    }

    /**
     * Get volreconstitucion
     *
     * @return float
     */
    public function getVolreconstitucion()
    {
        return $this->volreconstitucion;
    }

    /**
     * Set concentracion
     *
     * @param float $concentracion
     *
     * @return Guiaestabilidad
     */
    public function setConcentracion($concentracion)
    {
        $this->concentracion = $concentracion;

        return $this;
    }

    /**
     * Get concentracion
     *
     * @return float
     */
    public function getConcentracion()
    {
        return $this->concentracion;
    }

    /**
     * Set envase
     *
     * @param string $envase
     *
     * @return Guiaestabilidad
     */
    public function setEnvase($envase)
    {
        $this->envase = $envase;

        return $this;
    }

    /**
     * Get envase
     *
     * @return string
     */
    public function getEnvase()
    {
        return $this->envase;
    }

    /**
     * Set vehiculodilucion
     *
     * @param string $vehiculodilucion
     *
     * @return Guiaestabilidad
     */
    public function setVehiculodilucion($vehiculodilucion)
    {
        $this->vehiculodilucion = $vehiculodilucion;

        return $this;
    }

    /**
     * Get vehiculodilucion
     *
     * @return string
     */
    public function getVehiculodilucion()
    {
        return $this->vehiculodilucion;
    }

    /**
     * Set volvehiculodilucion
     *
     * @param float $volvehiculodilucion
     *
     * @return Guiaestabilidad
     */
    public function setVolvehiculodilucion($volvehiculodilucion)
    {
        $this->volvehiculodilucion = $volvehiculodilucion;

        return $this;
    }

    /**
     * Get volvehiculodilucion
     *
     * @return float
     */
    public function getVolvehiculodilucion()
    {
        return $this->volvehiculodilucion;
    }

    /**
     * Set viaadmon
     *
     * @param string $viaadmon
     *
     * @return Guiaestabilidad
     */
    public function setViaadmon($viaadmon)
    {
        $this->viaadmon = $viaadmon;

        return $this;
    }

    /**
     * Get viaadmon
     *
     * @return string
     */
    public function getViaadmon()
    {
        return $this->viaadmon;
    }

    /**
     * Set condicionesalmacenamiento
     *
     * @param string $condicionesalmacenamiento
     *
     * @return Guiaestabilidad
     */
    public function setCondicionesalmacenamiento($condicionesalmacenamiento)
    {
        $this->condicionesalmacenamiento = $condicionesalmacenamiento;

        return $this;
    }

    /**
     * Get condicionesalmacenamiento
     *
     * @return string
     */
    public function getCondicionesalmacenamiento()
    {
        return $this->condicionesalmacenamiento;
    }

    /**
     * Set fotosensible
     *
     * @param boolean $fotosensible
     *
     * @return Guiaestabilidad
     */
    public function setFotosensible($fotosensible)
    {
        $this->fotosensible = $fotosensible;

        return $this;
    }

    /**
     * Get fotosensible
     *
     * @return boolean
     */
    public function getFotosensible()
    {
        return $this->fotosensible;
    }

    /**
     * Set estabilidadmezcladias
     *
     * @param float $estabilidadmezcladias
     *
     * @return Guiaestabilidad
     */
    public function setEstabilidadmezcladias($estabilidadmezcladias)
    {
        $this->estabilidadmezcladias = $estabilidadmezcladias;

        return $this;
    }

    /**
     * Get estabilidadmezcladias
     *
     * @return float
     */
    public function getEstabilidadmezcladias()
    {
        return $this->estabilidadmezcladias;
    }

    /**
     * Set estabilidadmezclahoras
     *
     * @param float $estabilidadmezclahoras
     *
     * @return Guiaestabilidad
     */
    public function setEstabilidadmezclahoras($estabilidadmezclahoras)
    {
        $this->estabilidadmezclahoras = $estabilidadmezclahoras;

        return $this;
    }

    /**
     * Get estabilidadmezclahoras
     *
     * @return float
     */
    public function getEstabilidadmezclahoras()
    {
        return $this->estabilidadmezclahoras;
    }

    /**
     * Set estabilidadsobrantedias
     *
     * @param float $estabilidadsobrantedias
     *
     * @return Guiaestabilidad
     */
    public function setEstabilidadsobrantedias($estabilidadsobrantedias)
    {
        $this->estabilidadsobrantedias = $estabilidadsobrantedias;

        return $this;
    }

    /**
     * Get estabilidadsobrantedias
     *
     * @return float
     */
    public function getEstabilidadsobrantedias()
    {
        return $this->estabilidadsobrantedias;
    }

    /**
     * Set estabilidadsobrantehoras
     *
     * @param float $estabilidadsobrantehoras
     *
     * @return Guiaestabilidad
     */
    public function setEstabilidadsobrantehoras($estabilidadsobrantehoras)
    {
        $this->estabilidadsobrantehoras = $estabilidadsobrantehoras;

        return $this;
    }

    /**
     * Get estabilidadsobrantehoras
     *
     * @return float
     */
    public function getEstabilidadsobrantehoras()
    {
        return $this->estabilidadsobrantehoras;
    }

    /**
     * Set condialmacensobrante
     *
     * @param string $condialmacensobrante
     *
     * @return Guiaestabilidad
     */
    public function setCondialmacensobrante($condialmacensobrante)
    {
        $this->condialmacensobrante = $condialmacensobrante;

        return $this;
    }

    /**
     * Get condialmacensobrante
     *
     * @return string
     */
    public function getCondialmacensobrante()
    {
        return $this->condialmacensobrante;
    }

    /**
     * Set grupoterapeutico
     *
     * @param string $grupoterapeutico
     *
     * @return Guiaestabilidad
     */
    public function setGrupoterapeutico($grupoterapeutico)
    {
        $this->grupoterapeutico = $grupoterapeutico;

        return $this;
    }

    /**
     * Get grupoterapeutico
     *
     * @return string
     */
    public function getGrupoterapeutico()
    {
        return $this->grupoterapeutico;
    }

    /**
     * Set ordencampana
     *
     * @param string $ordencampana
     *
     * @return Guiaestabilidad
     */
    public function setOrdencampana($ordencampana)
    {
        $this->ordencampana = $ordencampana;

        return $this;
    }

    /**
     * Get ordencampana
     *
     * @return string
     */
    public function getOrdencampana()
    {
        return $this->ordencampana;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     *
     * @return Guiaestabilidad
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set tiempoinfusion
     *
     * @param string $tiempoinfusion
     *
     * @return Guiaestabilidad
     */
    public function setTiempoinfusion($tiempoinfusion)
    {
        $this->tiempoinfusion = $tiempoinfusion;

        return $this;
    }

    /**
     * Get tiempoinfusion
     *
     * @return string
     */
    public function getTiempoinfusion()
    {
        return $this->tiempoinfusion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Guiaestabilidad
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
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
    
    /**
     * Set idmedicamento
     *
     * @param \AppBundle\Entity\Medicamento $idmedicamento
     *
     * @return Guiaestabilidad
     */
    public function setIdmedicamento(\AppBundle\Entity\Medicamento $idmedicamento = null)
    {
        $this->idmedicamento = $idmedicamento;

        return $this;
    }

    /**
     * Get $idmedicamento
     *
     * @return \AppBundle\Entity\Medicamento
     */
    public function getIdmedicamento()
    {
        return $this->idmedicamento;
    }
    
    /**
     * Set idLineaProduccion
     *
     * @param \AppBundle\Entity\LineaProduccion $idLineaProduccion
     *
     * @return LineaProduccion
     */
    public function setLineaProduccion(\AppBundle\Entity\User $idLineaProduccion = null )
    {
        $this->idLineaProduccion = $idLineaProduccion;

        return $this;
    }

    /**
     * Get lineaProduccion
     *
     * @return string
     */
    public function getIdLineaProduccion()
    {
        return $this->idLineaProduccion;
    }
}
