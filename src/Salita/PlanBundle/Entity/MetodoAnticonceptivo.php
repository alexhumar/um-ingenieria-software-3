<?php

namespace Salita\PlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="metodoanticonceptivo")
 */

class MetodoAnticonceptivo
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
     * @ORM\OneToMany(targetEntity="Salita\PlanBundle\Entity\PlanProcResp", mappedBy="metodoAnticonceptivo")
     */
    protected $planesProcResp;

    public function __construct()
    {
        $this->planesProcResp= new ArrayCollection();
    }


    /**
     * Get idMetodoAnticonceptivo
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
     * Add planesProcResp
     *
     * @param Salita\PlanBundle\Entity\PlanProcResp $planesProcResp
     */
    public function addPlanProcResp(\Salita\PlanBundle\Entity\PlanProcResp $planesProcResp)
    {
        $this->planesProcResp[] = $planesProcResp;
    }

    /**
     * Get planesProcResp
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPlanesProcResp()
    {
        return $this->planesProcResp;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
