<?php
namespace Salita\PacienteBundle\Controller;

use Salita\OtrosBundle\Clases\MyController;
use Salita\PacienteBundle\Form\Type\FechasResumenHCType;
use Salita\OtrosBundle\Clases\ConsultaRol;
use Salita\OtrosBundle\Clases\FechasResumenHC;

class HistoriaClinicaController extends MyController
{
	
    private function ordenarVisitasPorFecha($toOrderArray, $field, $inverse = false)
    {  
        $position = array();  
        $newRow = array();  
        foreach ($toOrderArray as $key => $row)
        {  
            $position[$key]  = \DateTime::createFromFormat('d-m-Y', $row[$field]); 
            $newRow[$key] = $row;  
        }  
        if ($inverse)
        {  
            arsort($position);  
        }  
        else 
        {  
            asort($position);  
        }  
        $returnArray = array();  
        foreach ($position as $key => $pos)
        {       
            $returnArray[] = $newRow[$key];  
        }  
        return $returnArray;  
    }  

    private function visitasEntreFechas($visitas,$fechaDesde,$fechaHasta)
    {
        $resultado = array();
        foreach($visitas as $visita)
        {
            $fechaVisita = \DateTime::createFromFormat('d-m-Y', $visita['fecha']);
            if (($fechaVisita >= $fechaDesde) and ($fechaVisita <= $fechaHasta))
            {
                $resultado[] = $visita;
            }
        }
        return $resultado;
    }

    public function generarAction()
    {
       $session = $this->getSession();
       if(!$session->has('paciente'))
       {
           return $this->redirect($this->generateUrl('busqueda_paciente'));
       }
       $paciente = $session->get('paciente');
       $idPaciente = $paciente->getId();
       $paciente = $this->getReposManager()->getPacientesRepo()->find($idPaciente);
       /*Consultas*/
       $repoConsultas = $this->getReposManager()->getConsultasRepo();
       $consultas = $repoConsultas->obtenerConsultasDePaciente($idPaciente);
       /*Estudios*/
       $repoEstudios = $this->getReposManager()->getEstudiosRepo();
       $estudios = $repoEstudios->obtenerEstudiosDePaciente($idPaciente);
       /*Ordenamiento de visitas*/
       $consultas = $this->ordenarVisitasPorFecha($consultas,'fecha');
       $estudios = $this->ordenarVisitasPorFecha($estudios,'fecha');
       /*Aplicaciones de vacunas*/ 
       $repoAplicacionesVacuna = $this->getReposManager()->getAplicacionesVacunasRepo();
       $aplicaciones = $repoAplicacionesVacuna->aplicacionesVacunaDePaciente($idPaciente);
	   /*Antecedentes personales clinicos*/
       $repoAntecedentesPersonalesClinicos = $this->getReposManager()->getAntecedentesPersonalesClinicosRepo();
       $antecedentePersonalClinico = $repoAntecedentesPersonalesClinicos->buscarAntecedenteDePaciente($idPaciente);
       /*Antecedentes familiares clinicos*/
       $repoAntecedentesFamiliaresClinicos = $this->getReposManager()->getAntecedentesFamiliaresClinicosRepo();
       $antecedenteFamiliarClinico = $repoAntecedentesFamiliaresClinicos->buscarAntecedenteDePaciente($idPaciente);
       if($paciente->isMujer())
       {
       	   /*Antecedentes personales obstetricos*/
           $repoAntecedentesPersonalesObstetricos = $this->getReposManager()->getAntecedentesPersonalesObstetricosRepo();
           $antecedentePersonalObstetrico = $repoAntecedentesPersonalesObstetricos->buscarAntecedenteDePaciente($idPaciente); 
           /*Antecedentes familiares obstetricos*/
           $repoAntecedentesFamiliaresObstetricos = $this->getReposManager()->getAntecedentesFamiliaresObstetricosRepo();
           $antecedenteFamiliarObstetrico = $repoAntecedentesFamiliaresObstetricos->buscarAntecedenteDePaciente($idPaciente);
       }
       else
       {
           $antecedentePersonalObstetrico = null;
           $antecedenteFamiliarObstetrico = null;
       }
       $usuarioGenerador = $session->get('usuario');
       $usuarioGenerador = $this->getReposManager()->getUsuariosRepo()->find($usuarioGenerador->getId());
       return $this->render(
       			'SalitaPacienteBundle:HistoriaClinica:generacionHC.html.twig', 
       			array('paciente' => $paciente,'antecedentePC' => $antecedentePersonalClinico,
       				  'antecedenteFC' => $antecedenteFamiliarClinico,
       				  'antecedenteFO' => $antecedenteFamiliarObstetrico,
       				  'antecedentePO' => $antecedentePersonalObstetrico,
       				  'consultas' => $consultas, 'estudios' => $estudios, 
       				  'usuarioGenerador' => $usuarioGenerador, 'aplicaciones' => $aplicaciones)
       		);
    }
    
    public function resumenAction()
    {
       $session = $this->getSession();
       if(!$session->has('paciente'))
       {
           return $this->redirect($this->generateUrl('busqueda_paciente'));
       }
       if(!$session->has('fechaDesde'))
       {
           return $this->redirect($this->generateUrl('fechas_resumenHC'));
       }
       $paciente = $session->get('paciente');
       $idPaciente = $paciente->getId();
       $paciente = $this->getReposManager()->getPacientesRepo()->find($idPaciente);
       $fechaDesde = \DateTime::createFromFormat('d-m-Y', $session->get('fechaDesde'));
       $fechaHasta = \DateTime::createFromFormat('d-m-Y', $session->get('fechaHasta'));
       $repoEstudios = $this->getReposManager()->getEstudiosRepo();
       $repoConsultas = $this->getReposManager()->getConsultasRepo();
       $consultas = $repoConsultas->obtenerConsultasDePaciente($idPaciente);
       $estudios = $repoEstudios->obtenerEstudiosDePaciente($idPaciente); 
       $consultas = $this->visitasEntreFechas($consultas, $fechaDesde, $fechaHasta);
       $consultas = $this->ordenarVisitasPorFecha($consultas, 'fecha');
       $estudios = $this->visitasEntreFechas($estudios, $fechaDesde, $fechaHasta);
       $estudios = $this->ordenarVisitasPorFecha($estudios, 'fecha');
       $session->remove('fechaDesde');
       $session->remove('fechaHasta');
       $usuarioGenerador = $session->get('usuario');
       $usuarioGenerador = $this->getReposManager()->getUsuariosRepo()->find($usuarioGenerador->getId());                  
       return $this->render(
       			'SalitaPacienteBundle:HistoriaClinica:resumenHC.html.twig',
       			array('paciente' => $paciente ,'consultas' => $consultas, 
       				  'usuarioGenerador' => $usuarioGenerador, 'estudios' => $estudios)
       		);
    }
    
    /*Eleccion de fechas para el resumen de historia clinica*/
    public function elegirFechasAction()
    {
    	$session = $this->getSession();
    	if(!$session->has('paciente'))
    	{
    		return $this->redirect($this->generateUrl('busqueda_paciente'));
    	}
   		$fechas = new FechasResumenHC();
   		$form = $this->createForm(new FechasResumenHCType(), $fechas);
   		$request = $this->getRequest();
  		$form->handleRequest($request);
  		if ($form->isValid())
  		{
  			$session->set('fechaDesde', $fechas->getFechaDesde());
  			$session->set('fechaHasta', $fechas->getFechaHasta());
  			return $this->redirect($this->generateUrl('generar_resumenHC'));
  		}
  		return $this->render(
  				'SalitaPacienteBundle:HistoriaClinica:ingresoFechas.html.twig',
  				array('form' => $form->createView())
  		);
    }
}