<?php

namespace App\Form;

use App\Entity\ZoneDePrelevement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZoneDePrelevementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('PositionX1')
            ->add('PositionY1')
            ->add('PositionX2')
            ->add('PositionY2')
            ->add('PositionX3')
            ->add('PositionY3')
            ->add('PositionX4')
            ->add('PositionY4')
            ->add('plage')
            ->add('ZoneDePrelevementHasEspece')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ZoneDePrelevement::class,
        ]);
    }
}
