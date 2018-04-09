<?php

namespace AppBundle\Entity;
 
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=150, nullable=true)
     */
    private $nombres;
    
    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=150, nullable=true)
     */
    private $apellidos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=20, nullable=true)
     */
    private $documento;
 
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    
    /**
     * Set nombres
     *
     * @param string $nombres
     *
     * @return User
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }
    
    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Guiaestabilidad
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
    
    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Guiaestabilidad
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }
}
