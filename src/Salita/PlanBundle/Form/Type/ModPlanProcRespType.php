<?php
namespace Salita\PlanBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ModPlanProcRespType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('periodicidad', null, array('required' => 'false', 'label' => 'form.modPlanProcRespType.label.periodicidad'))
            ->add('modificar', 'submit', array('label' => 'form.modPlanProcRespType.boton.modificar'));
    }

    public function getName()
    {
        return 'modifplanprocresp';
    }
}