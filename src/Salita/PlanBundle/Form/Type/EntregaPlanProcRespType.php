<?php
namespace Salita\PlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EntregaPlanProcRespType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$builder->add('confirmar', 'submit', array('label' => 'form.entregaPlanProcRespType.boton.confirmar'));
    }

    public function getName()
    {
        return 'entregaplanprocresp';
    }
}