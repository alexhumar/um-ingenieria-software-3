<?php
namespace Salita\PlanBundle\Controller;

use Salita\PlanBundle\Form\Type\PlanProcRespType;
use Salita\PlanBundle\Form\Type\ModPlanProcRespType;
use Salita\PlanBundle\Entity\PlanProcResp;
use Salita\OtrosBundle\Clases\MyController;

class PlanProcRespFormController extends MyController
{
    
    /*Alta de plan de procreacion responsable*/
    public function newAction()
    {
    	$plan = new PlanProcResp();
    	$form = $this->createForm(new PlanProcRespType(), $plan);
    	$request = $this->getRequest();
   		$form->handleRequest($request);
   		if ($form->isValid())
   		{
   			$session = $this->getSession();
   			$paciente = $session->get('paciente');
   			$this->getPersistenceManager()->savePlanProcreacionResponsable($plan, $paciente);
   			$nextAction = $form->get('guardarynuevo')->isClicked()
   			    ? 'alta_planprocresp'
   			    : 'resultado_operacion_plan';
   			$sessionManager = $this->getSessionManager();
   			$translator = $this->getTranslator();
   			$mensaje = $this->getDialogsManager()->cargaPlanPacienteExitoMsg();
   			$sessionManager->setMensajeResultadoOperacion($nextAction, $translator->trans($mensaje));
   			return $this->redirect($this->generateUrl($nextAction));
   		}
   		return $this->render(
   					'SalitaPlanBundle:PlanProcRespForm:new.html.twig',
   					array('form' => $form->createView())
   				);
    }
    
    /*Modificacion de plan de procreacion responsable*/
    public function modifAction($idPlan)
    {
    	$repoPlanes = $this->getReposManager()->getPlanesProcreacionResponsableRepo();
    	$plan = $repoPlanes->find($idPlan);
    	$translator = $this->getTranslator();
    	if(!$plan)
    	{
    		$mensaje = $this->getDialogsManager()->getPlanPacienteInexistenteMsg();
    		throw $this->createNotFoundException($translator->trans($mensaje));
    	}
    	$form = $this->createForm(new ModPlanProcRespType(), $plan);
    	$request = $this->getRequest();
   		$form->handleRequest($request);
   		if ($form->isValid())
   		{
   			$this->getPersistenceManager()->updatePlanProcreacionResponsable($plan);
   			$session = $this->getSession();
   			$mensaje = $this->getDialogsManager()->modifPlanPacienteExitoMsg();
   			$session->set('mensaje', $translator->trans($mensaje));
   			return $this->redirect($this->generateUrl('resultado_operacion_plan'));
   		}
   		return $this->render(
           			'SalitaPlanBundle:PlanProcRespForm:modif.html.twig',
           			array('form' => $form->createView(),'id' => $idPlan)
           		);
    }

    function listAction()
    {
        $repoPlanes = $this->getReposManager()->getPlanesProcreacionResponsableRepo();
        $session = $this->getSession();
        $planes = $repoPlanes->findAllById($session->get('paciente')->getId());
        return $this->render(
        			'SalitaPlanBundle:PlanProcRespForm:listado.html.twig',
        			array('planes' => $planes)
        		);
    }

    function listDesAction()
    {
        $repoPlanes = $this->getReposManager()->getPlanesProcreacionResponsableRepo();
        $session = $this->getSession();
        $planes = $repoPlanes->findAllByIdDes($session->get('paciente')->getId());
        return $this->render(
        			'SalitaPlanBundle:PlanProcRespForm:listadoDes.html.twig',
        			array('planes' => $planes)
        		);
    }

    function habAction($idPlan)
    {
        $repoPlanes = $this->getReposManager()->getPlanesProcreacionResponsableRepo();
        $repoPlanes->habilitar($idPlan);
        return $this->redirect($this->generateUrl('listadoDes_planprocresp'));
    }

    function deshabAction($idPlan)
    {
        $repoPlanes = $this->getReposManager()->getPlanesProcreacionResponsableRepo();
        $repoPlanes->deshabilitar($idPlan);
        return $this->redirect($this->generateUrl('listado_planprocresp'));
    }
}