<?php

namespace Salita\UsuarioBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Salita\UsuarioBundle\Repository\RolRepository")
 * @ORM\Table(name="rol")
 */

class Rol
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;

    /**
     * @ORM\Column(type="string", length=15, unique=true, nullable=false)
     */
     protected $nombre; 

    /**
     * @ORM\ManyToMany(targetEntity="Salita\UsuarioBundle\Entity\Usuario", mappedBy="rol")
     */
    protected $usuarios;

    /**
     * @ORM\Column(type="string", length=20, unique=true, nullable=false)
     */
     protected $codigo;
    

    public function __construct() {
        $this->usuarios = new ArrayCollection();
    }

    /**
     * Get idRol
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
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
     * Add usuarios
     *
     * @param Salita\UsuarioBundle\Entity\Usuario $usuarios
     */
    public function addUsuario(\Salita\UsuarioBundle\Entity\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    }

    /**
     * Get usuarios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
    
    public static function getCodigoRolAdmin()
    {
    	return "ROLE_ADMIN";
    }
    
    public static function getCodigoRolAdministrador()
    {
    	return "ROLE_ADMINISTRADOR";
    }
    
    public static function getCodigoRolMedico()
    {
    	return "ROLE_MEDICO";
    }
    
    public static function getCodigoRolSecretaria()
    {
    	return "ROLE_SECRETARIA";
    }
    
    public function isRoleAdministrador()
    {
    	return $this->getCodigo() == self::getCodigoRolAdministrador();
    }
    
    public function isRoleMedico()
    {
    	return $this->getCodigo() == self::getCodigoRolMedico();
    }
    
    public function isRoleSecretaria()
    {
    	return $this->getCodigo() == self::getCodigoRolSecretaria();
    }
    
    public function getCodigoWithQuotes()
    {
    	/*Esto lo uso mas que nada para los templates*/
    	return "'" . $this->getCodigo() . "'";
    }
}
