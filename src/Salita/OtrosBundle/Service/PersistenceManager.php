<?php
namespace Salita\OtrosBundle\Service;

use Salita\OtrosBundle\Service\ReposManager;
use Salita\OtrosBundle\Entity\AplicacionVacuna;
use Salita\PacienteBundle\Entity\AntecedentePersonalClinico;
use Salita\PacienteBundle\Entity\AntecedentePersonalObstetrico;
use Salita\PacienteBundle\Entity\AntecedenteFamiliarClinico;
use Salita\PacienteBundle\Entity\AntecedenteFamiliarObstetrico;
use Salita\UsuarioBundle\Entity\Rol;

class PersistenceManager
{
	protected $reposManager;
	
	public function __construct(ReposManager $reposManager)
	{
		$this->reposManager = $reposManager;
	}
	
	public function getReposManager()
	{
		return $this->reposManager;
	}
	
	/*Metodos de TurnoBundle*/
	public function saveTurno($turno, $medico, $paciente, $fecha, $hora)
	{
		/*Si no agrego esto, falla doctrine... como que necesita que los objetos vengan de los repos asi les
		 * mantiene la pista*/
		$repoPacientes = $this->getReposManager()->getPacientesRepo();
		$repoUsuarios = $this->getReposManager()->getUsuariosRepo();
		$paciente = $repoPacientes->find($paciente->getId());
		$medico = $repoUsuarios->find($medico->getId());
		$turno->setPaciente($paciente);
		$turno->setUsuario($medico);
		$turno->setFecha($fecha);
		$turno->setHora($hora);
		$turno->setAtendido(false);
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($turno);
		$em->flush();
	}
	
	public function saveNowTurno($turno, $medico, $paciente)
	{
		$this->saveTurno($turno, $medico, $paciente, date("d-m-Y"), date("H:i:s"));
	}
	
	public function setTurnoAtendido($idTurno, $controller)
	{
		$em = $this->getReposManager()->getEntityManager();
		$repoTurnos = $this->getReposManager()->getTurnosRepo();
		$turno = $repoTurnos->find($idTurno);
		if(!$turno)
		{
			throw $controller->createNotFoundException("No existe el turno solicitado");
		}
		$turno->setAtendido(true);
		$em->persist($turno);
		$em->flush();
	}
	
	/*Metodos de OtrosBundle*/
	public function saveBarrio($barrio)
	{
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($barrio);
		$em->flush();
	}
	
	public function saveLocalidad($localidad)
	{
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($localidad);
		$em->flush();
	}
	
	public function saveMetodoDeEstudio($metodo)
	{
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($metodo);
		$em->flush();
	}
	
	public function savePais($pais)
	{
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($pais);
		$em->flush();
	}

	public function savePartido($partido)
	{
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($partido);
		$em->flush();
	}
	
	public function updatePartido($partido)
	{
		/* $partido se obtuvo de una consulta al repositorio de partidos,
		 * por lo que no es necesaria la ejecucion del metodo persist*/
		$em = $this->getReposManager()->getEntityManager();
		//$em->persist($partido);
		$em->flush();
	}
	
	/*Metodos de UsuarioBundle*/
	public function assignRolAUsuario($usuario, $rol)
	{
		/*Aclaracion: tanto el usuario como el rol deben venir traidos de sus respectivos repos*/
		$usuario->setEnabled(true);
		$usuario->agregarRol($rol);
		$em = $this->getReposManager()->getEntityManager();
		//no hace falta--$em->persist($usuario);
		$em->flush();
	}
	
	public function removeUsuario($usuario)
	{
		/*Aclaracion: el usuario debe venir traido del repo de usuarios*/
		$em = $this->getReposManager()->getEntityManager();
		$em->remove($usuario);
		$em->flush();
	}
	
	public function removeRolAUsuario($usuario, $rol)
	{
		/*Aclaracion: tanto el usuario como el rol deben venir traidos de sus respectivos repos*/
		$usuario->quitarRol($rol);
		/* Si el rol quitado es de medico, se le elimina la especialidad */
		if ($rol->getCodigo() == Rol::getCodigoRolMedico())
		{
			$usuario->setEspecialidad(null);
		}
		$em = $this->getReposManager()->getEntityManager();
		$em->flush();
	}
	
	public function getRepoUserFromSessionUser($usuario, $controller)
	{
		$repoUsuarios = $this->getReposManager()->getUsuariosRepo();
		$usuario = $repoUsuarios->find($usuario->getId());
		if(!$usuario)
		{
			throw $controller->createNotFoundException("Usuario inexistente");
		}
		return $usuario;
	}
	
	public function getRepoPacientFromSessionPacient($paciente, $controller)
	{
		$repoPacientes = $this->getReposManager()->getPacientesRepo();
		$paciente = $repoPacientes->find($paciente->getId());
		if(!$paciente)
		{
			throw $controller->createNotFoundException("Usuario inexistente");
		}
		return $paciente;
	}
	
	/*Metodos de PlanBundle*/
	public function saveEntregaPlanProcreacionResponsable($plan, $entrega)
	{
		$entrega->setFecha(date("d-m-Y"));
		$entrega->setPlan($plan);
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($entrega);
		$em->flush();
	}
	
	public function saveMetodoAnticonceptivo($metodo)
	{
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($metodo);
		$em->flush();
	}
	
	public function savePlanProcreacionResponsable($plan, $paciente)
	{
		$paciente = $this->getReposManager()->getPacientesRepo()->find($paciente->getId());
		$plan->setPaciente($paciente);
		$plan->setFinalizado('0');
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($plan);
		$em->flush();
	}
	
	public function updatePlanProcreacionResponsable($plan)
	{
		$em = $this->getReposManager()->getEntityManager();
		/*Plan es un objeto "vigilado" por Doctrine, por lo que no es necesaria la invocacion
		 * del metodo persist*/
		$em->flush();
	}
	
	/*Metodos de PacienteBundle*/
	public function createAplicacionVacuna($paciente, $vacuna)
	{
		$paciente = $this->getReposManager()->getPacientesRepo()->find($paciente->getId());
		$vacuna = $this->getReposManager()->getVacunasRepo()->find($vacuna->getId());
		$aplicacion = new AplicacionVacuna();
		$aplicacion->setFecha(date("d-m-Y"));
		$aplicacion->setPaciente($paciente);
		$aplicacion->setVacuna($vacuna);
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($aplicacion);
		/*Me parece que el persist de paciente no hace falta*/
		$em->persist($paciente);
		$em->flush();
	}
	
	public function saveConsulta($consulta, $paciente, $usuario, $diagnostico)
	{
		$paciente = $this->getReposManager()->getPacientesRepo()->find($paciente->getId());
		$usuario = $this->getReposManager()->getUsuariosRepo()->find($usuario->getId());
		$diagnostico = $this->getReposManager()->getDiagnosticosRepo()->find($diagnostico->getId());
		$consulta->setPaciente($paciente);
		$consulta->setUsuario($usuario);
		$consulta->setDiagnostico($diagnostico);
		$consulta->setFecha(date("d-m-Y"));
		$consulta->setHora(date("H:i:s"));
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($consulta);
		$em->flush();
	}
	
	public function saveEstudio($estudio, $paciente, $usuario)
	{
		$paciente = $this->getReposManager()->getPacientesRepo()->find($paciente->getId());
		$usuario = $this->getReposManager()->getusuariosRepo()->find($usuario->getId());
		$estudio->setPaciente($paciente);
		$estudio->setUsuario($usuario);
		$estudio->setFecha(date("d-m-Y"));
		$estudio->setHora(date("H:i:s"));
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($estudio);
		$em->flush();
	}
	
	public function savePaciente($paciente)
	{
		/* Todos los persists en este metodo son necesarios */
		$antecedentePersonalObstetrico = new AntecedentePersonalObstetrico();
		$antecedentePersonalObstetrico->setPaciente($paciente);
		$antecedenteFamiliarObstetrico = new AntecedenteFamiliarObstetrico();
		$antecedenteFamiliarObstetrico->setPaciente($paciente);
		$antecedentePersonalClinico = new AntecedentePersonalClinico();
		$antecedentePersonalClinico->setPaciente($paciente);
		$antecedenteFamiliarClinico = new AntecedenteFamiliarClinico();
		$antecedenteFamiliarClinico->setPaciente($paciente);
		$em = $this->getReposManager()->getEntityManager();
		$em->persist($antecedentePersonalObstetrico);
		$em->persist($antecedenteFamiliarObstetrico);
		$em->persist($antecedentePersonalClinico);
		$em->persist($antecedenteFamiliarClinico);
		$em->persist($paciente);
		$em->flush();
	}
}