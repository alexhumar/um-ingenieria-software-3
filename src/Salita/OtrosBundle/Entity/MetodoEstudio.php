<?php

namespace Salita\OtrosBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="metodoestudio")
 */

class MetodoEstudio
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Salita\PacienteBundle\Entity\Estudio", mappedBy="metodoEstudio")
     */
    protected $estudios;

    public function __construct()
    {
        $this->estudios= new ArrayCollection();
    }


    /**
     * Get idMetodoEstudio
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
     * Add estudios
     *
     * @param Salita\PacienteBundle\Entity\Estudio $estudios
     */
    public function addEstudio(\Salita\PacienteBundle\Entity\Estudio $estudios)
    {
        $this->estudios[] = $estudios;
    }

    /**
     * Get estudios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEstudios()
    {
        return $this->estudios;
    }
}
