<?php

namespace Salita\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Salita\PlanBundle\Repository\EntregaPlanProcRespRepository")
 * @ORM\Table(name="entregaplanprocresp")
 */

class EntregaPlanProcResp
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Salita\PlanBundle\Entity\PlanProcResp", inversedBy="entregas")
     * @ORM\JoinColumn(name="idPlanProcResp", referencedColumnName="id")
     */
    protected $plan;


    /**
     * Get idEntregaPlanProcResp
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param date $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return date 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set plan
     *
     * @param Salita\PlanBundle\Entity\PlanProcResp $plan
     */
    public function setPlan(\Salita\PlanBundle\Entity\PlanProcResp $plan)
    {
        $this->plan = $plan;
    }

    /**
     * Get plan
     *
     * @return Salita\PlanBundle\Entity\PlanProcResp 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
