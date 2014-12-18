<?php

namespace Salita\PacienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="tipo", type="string")
 * @ORM\DiscriminatorMap({"Clinico" = "AntecedenteFamiliarClinico", "Obstetrico" = "AntecedenteFamiliarObstetrico"})
 */
abstract class AntecedenteFamiliar
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $tuberculosis;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $diabetes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $hipertensionArterial;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $otros;

    /**
     * @ORM\ManyToOne(targetEntity="Salita\PacienteBundle\Entity\Paciente", inversedBy="antecedenteFamiliar")
     * @ORM\JoinColumn(name="idPaciente", referencedColumnName="id", unique=false)
     */
    protected $paciente;


    /**
     * Get idAntecedenteFamiliar
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tuberculosis
     *
     * @param boolean $tuberculosis
     */
    public function setTuberculosis($tuberculosis)
    {
        $this->tuberculosis = $tuberculosis;
    }

    /**
     * Get tuberculosis
     *
     * @return boolean 
     */
    public function getTuberculosis()
    {
        return $this->tuberculosis;
    }

    /**
     * Set diabetes
     *
     * @param boolean $diabetes
     */
    public function setDiabetes($diabetes)
    {
        $this->diabetes = $diabetes;
    }

    /**
     * Get diabetes
     *
     * @return boolean 
     */
    public function getDiabetes()
    {
        return $this->diabetes;
    }

    /**
     * Set hipertensionArterial
     *
     * @param boolean $hipertensionArterial
     */
    public function setHipertensionArterial($hipertensionArterial)
    {
        $this->hipertensionArterial = $hipertensionArterial;
    }

    /**
     * Get hipertensionArterial
     *
     * @return boolean 
     */
    public function getHipertensionArterial()
    {
        return $this->hipertensionArterial;
    }

    /**
     * Set otros
     *
     * @param text $otros
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;
    }

    /**
     * Get otros
     *
     * @return text 
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set paciente
     *
     * @param Salita\PacienteBundle\Entity\Paciente $paciente
     */
    public function setPaciente(\Salita\PacienteBundle\Entity\Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * Get paciente
     *
     * @return Salita\PacienteBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }
}
