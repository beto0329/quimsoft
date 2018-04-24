<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LineaProduccion
 *
 * @ORM\Table(name="lineaproduccion")
 * @ORM\Entity
 */
class LineaProduccion
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
     * @ORM\Column(name="linea_produccion", type="string", length=150, nullable=false)
     */
    private $lineaProduccion;
    
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
     * Set lineaProduccion
     *
     * @param string $lineaProduccion
     *
     * @return LineaProduccion
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
     * Set current
     *
     * @param \DateTime $current
     *
     * @return LineaProduccion
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
