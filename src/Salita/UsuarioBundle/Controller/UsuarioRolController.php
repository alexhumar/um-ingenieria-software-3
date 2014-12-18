<?php
namespace Salita\UsuarioBundle\Controller;

use Salita\OtrosBundle\Clases\MyController;
use Salita\OtrosBundle\Clases\MisRoles;
use Salita\OtrosBundle\Clases\ConsultaRol;
use Salita\UsuarioBundle\Entity\Rol;
use Salita\UsuarioBundle\Clases\RolTemporal;
use Salita\UsuarioBundle\Form\Type\RolType;

class UsuarioRolController extends MyController
{
	
    public function elegirAction()
    {
       $repoRoles = $this->getReposManager()->getRolesRepo();
       $repoUsuarios = $this->getReposManager()->getUsuariosRepo();
       $usuario = $this->getSessionUser();
       $usuario = $repoUsuarios->find($usuario->getId());
       $session = $this->getSession();
       $session->set('usuario', $usuario);
       if(($usuario->isAdministrador()) and ($usuario->isMedico()))
       {
           /*Prepara el formulario para la seleccion de rol (O rol medico o rol administrador)*/
           $roles = $repoRoles->rolesAdministradorYMedico();
           $rolTemp = new RolTemporal();
           $form = $this->createForm(new RolType($roles), $rolTemp);
           $request = $this->getRequest();
           $form->handleRequest($request);
           if ($form->isValid())
           {
               $rolSeleccionado = $repoRoles->findOneByCodigo($rolTemp->getNombre());
               $session->set('rolSeleccionado', $rolSeleccionado);
           }
           else
           {
               return $this->render(
                          'SalitaUsuarioBundle:EleccionRolForm:eleccionRol.html.twig',
                          array('form' => $form->createView())
                      );
           }
       }
       else
       {
           $rolesUsuario = $usuario->getRoles();
           /*Esto es un parche para que seleccione bien el rol de un usuario si es administrador, ya que su primer rol es ROLE_ADMIN, y si se selecciona
           ese rol, crashea la consulta en $repoRoles*/
           if (in_array(Rol::getCodigoRolAdmin(), $rolesUsuario))
           {
               $index = 1;
           }
           else
           {
               $index = 0;
           }
           $rolUsuario = $repoRoles->findOneByCodigo($rolesUsuario[$index]);
           $session->set('rolSeleccionado', $rolUsuario);
       }
       
       /* Si ingreso al sistema como medico */
       if (ConsultaRol::rolSeleccionado($session)->getCodigo() == Rol::getCodigoRolMedico())
       {
       	   /*Esto lo hago para que Doctrine reemplace el proxy Especialidad por el objeto
       	    * real con los datos traidos de la bd*/
       	   $usuario->getEspecialidad()->getCodigo();
       	   $session->set('especialidad', $usuario->getEspecialidad());
       }
       return $this->redirect($this->generateUrl('menu_principal'));
    }
}