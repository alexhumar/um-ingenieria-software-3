<?php

namespace Salita\PacienteBundle\Entity;

use Salita\PacienteBundle\Entity\Visita;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Salita\PacienteBundle\Repository\ConsultaRepository")
 */
class Consulta extends Visita
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    protected $otrasAnotaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Salita\OtrosBundle\Entity\Diagnostico", inversedBy="consultas")
     * @ORM\JoinColumn(name="idDiagnostico", referencedColumnName="id")
     */
    protected $diagnostico;

    /**
     * @var date $fecha
     */
    protected $fecha;

    /**
     * @var time $hora
     */
    protected $hora;


    /**
     * Get idConsulta
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set otrasAnotaciones
     *
     * @param text $otrasAnotaciones
     */
    public function setOtrasAnotaciones($otrasAnotaciones)
    {
        $this->otrasAnotaciones = $otrasAnotaciones;
    }

    /**
     * Get otrasAnotaciones
     *
     * @return text 
     */
    public function getOtrasAnotaciones()
    {
        return $this->otrasAnotaciones;
    }

    /**
     * Get idVisita
     *
     * @return integer 
     */
    public function getIdVisita()
    {
        return $this->idVisita;
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
     * Set hora
     *
     * @param time $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * Get hora
     *
     * @return time 
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set diagnostico
     *
     * @param Salita\OtrosBundle\Entity\Diagnostico $diagnostico
     */
    public function setDiagnostico(\Salita\OtrosBundle\Entity\Diagnostico $diagnostico)
    {
        $this->diagnostico = $diagnostico;
    }

    /**
     * Get diagnostico
     *
     * @return Salita\OtrosBundle\Entity\Diagnostico 
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

}
