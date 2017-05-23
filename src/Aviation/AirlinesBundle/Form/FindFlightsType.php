<?php

namespace Aviation\AirlinesBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class FindFlightsType extends AbstractType {
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('From', TextType::class, ['label' => 'Departure Airport Name',])
            ->add('To', TextType::class, ['label' => 'Destination Airport Name'])
            ->add('On', DateType::class)
            ->add('Search', SubmitType::class, ['attr' => ['class' => 'btn btn-lg btn-success btn-block']]);
    }


}