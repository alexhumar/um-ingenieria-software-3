<?php

namespace Salita\PacienteBundle\Entity;

use Salita\PacienteBundle\Entity\AntecedentePersonal;
use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity(repositoryClass="Salita\PacienteBundle\Repository\AntecedentePersonalObstetricoRepository")
 */
class AntecedentePersonalObstetrico extends AntecedentePersonal
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
    protected $cirugiaPelviana;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $infertilidad;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $vih;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $cardiopatiaNefropatia;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $condicionMedicaGrave;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $gestasPrevias;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $abortos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cesareas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $partos;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $sifilis;

    /**
     * @var boolean $tuberculosis
     */
    protected $tuberculosis;

    /**
     * @var boolean $diabetes
     */
    protected $diabetes;

    /**
     * @var boolean $hipertensionArterial
     */
    protected $hipertensionArterial;

    /**
     * @var boolean $drogas
     */
    protected $drogas;

    /**
     * @var boolean $tabaquismo
     */
    protected $tabaquismo;

    /**
     * @var boolean $alcoholismo
     */
    protected $alcoholismo;

    /**
     * @var text $otros
     */
    protected $otros;


    /**
     * Get idAntecedentePersonalObstetrico
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cirugiaPelviana
     *
     * @param boolean $cirugiaPelviana
     */
    public function setCirugiaPelviana($cirugiaPelviana)
    {
        $this->cirugiaPelviana = $cirugiaPelviana;
    }

    /**
     * Get cirugiaPelviana
     *
     * @return boolean 
     */
    public function getCirugiaPelviana()
    {
        return $this->cirugiaPelviana;
    }

    /**
     * Set infertilidad
     *
     * @param boolean $infertilidad
     */
    public function setInfertilidad($infertilidad)
    {
        $this->infertilidad = $infertilidad;
    }

    /**
     * Get infertilidad
     *
     * @return boolean 
     */
    public function getInfertilidad()
    {
        return $this->infertilidad;
    }

    /**
     * Set vih
     *
     * @param boolean $vih
     */
    public function setVih($vih)
    {
        $this->vih = $vih;
    }

    /**
     * Get vih
     *
     * @return boolean 
     */
    public function getVih()
    {
        return $this->vih;
    }

    /**
     * Set cardiopatiaNefropatia
     *
     * @param boolean $cardiopatiaNefropatia
     */
    public function setCardiopatiaNefropatia($cardiopatiaNefropatia)
    {
        $this->cardiopatiaNefropatia = $cardiopatiaNefropatia;
    }

    /**
     * Get cardiopatiaNefropatia
     *
     * @return boolean 
     */
    public function getCardiopatiaNefropatia()
    {
        return $this->cardiopatiaNefropatia;
    }

    /**
     * Set condicionMedicaGrave
     *
     * @param boolean $condicionMedicaGrave
     */
    public function setCondicionMedicaGrave($condicionMedicaGrave)
    {
        $this->condicionMedicaGrave = $condicionMedicaGrave;
    }

    /**
     * Get condicionMedicaGrave
     *
     * @return boolean 
     */
    public function getCondicionMedicaGrave()
    {
        return $this->condicionMedicaGrave;
    }

    /**
     * Set gestasPrevias
     *
     * @param integer $gestasPrevias
     */
    public function setGestasPrevias($gestasPrevias)
    {
        $this->gestasPrevias = $gestasPrevias;
    }

    /**
     * Get gestasPrevias
     *
     * @return integer 
     */
    public function getGestasPrevias()
    {
        return $this->gestasPrevias;
    }

    /**
     * Set abortos
     *
     * @param integer $abortos
     */
    public function setAbortos($abortos)
    {
        $this->abortos = $abortos;
    }

    /**
     * Get abortos
     *
     * @return integer 
     */
    public function getAbortos()
    {
        return $this->abortos;
    }

    /**
     * Set cesareas
     *
     * @param integer $cesareas
     */
    public function setCesareas($cesareas)
    {
        $this->cesareas = $cesareas;
    }

    /**
     * Get cesareas
     *
     * @return integer 
     */
    public function getCesareas()
    {
        return $this->cesareas;
    }

    /**
     * Set partos
     *
     * @param integer $partos
     */
    public function setPartos($partos)
    {
        $this->partos = $partos;
    }

    /**
     * Get partos
     *
     * @return integer 
     */
    public function getPartos()
    {
        return $this->partos;
    }

    /**
     * Set sifilis
     *
     * @param boolean $sifilis
     */
    public function setSifilis($sifilis)
    {
        $this->sifilis = $sifilis;
    }

    /**
     * Get sifilis
     *
     * @return boolean 
     */
    public function getSifilis()
    {
        return $this->sifilis;
    }

    /**
     * Get idAntecedentePersonal
     *
     * @return integer 
     */
    public function getIdAntecedentePersonal()
    {
        return $this->idAntecedentePersonal;
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
     * Set drogas
     *
     * @param boolean $drogas
     */
    public function setDrogas($drogas)
    {
        $this->drogas = $drogas;
    }

    /**
     * Get drogas
     *
     * @return boolean 
     */
    public function getDrogas()
    {
        return $this->drogas;
    }

    /**
     * Set tabaquismo
     *
     * @param boolean $tabaquismo
     */
    public function setTabaquismo($tabaquismo)
    {
        $this->tabaquismo = $tabaquismo;
    }

    /**
     * Get tabaquismo
     *
     * @return boolean 
     */
    public function getTabaquismo()
    {
        return $this->tabaquismo;
    }

    /**
     * Set alcoholismo
     *
     * @param boolean $alcoholismo
     */
    public function setAlcoholismo($alcoholismo)
    {
        $this->alcoholismo = $alcoholismo;
    }

    /**
     * Get alcoholismo
     *
     * @return boolean 
     */
    public function getAlcoholismo()
    {
        return $this->alcoholismo;
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

}
