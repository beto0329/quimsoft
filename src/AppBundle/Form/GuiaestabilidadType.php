<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuiaestabilidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombremedicamento')->add('laboratorio')->add('nombrelasa')->add('presentacionfavorita')->add('unidadmediad')->add('volreconstitucion')->add('concentracion')->add('envase')->add('vehiculodilucion')->add('volvehiculodilucion')->add('viaadmon')->add('condicionesalmacenamiento')->add('fotosensible')->add('estabilidadmezcladias')->add('estabilidadmezclahoras')->add('estabilidadsobrantedias')->add('estabilidadsobrantehoras')->add('condialmacensobrante')->add('grupoterapeutico')->add('ordencampana')->add('referencia')->add('tiempoinfusion')->add('tipo');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Guiaestabilidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_guiaestabilidad';
    }


}
