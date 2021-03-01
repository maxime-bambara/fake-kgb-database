<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Skills;
use App\Entity\Targets;
use App\Entity\Contacts;
use App\Entity\Hideaway;
use App\Entity\Missions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('code', TextType::class)
            ->add('country', TextType::class)
            ->add('startDate', DateType::class, [
                'format' => 'dd-MM-yyyy',
            ])
            ->add('endDate', DateType::class, [
                'format' => 'dd-MM-yyyy',
            ])
            ->add('agents', EntityType::class, [
                'choice_label' => 'code',
                'class' => Agents::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('skills', EntityType::class, [
                'choice_label' => 'name',
                'class' => Skills::class,
            ])
            ->add('hideaway', EntityType::class, [
                'choice_label' => 'alias',
                'class' => Hideaway::class,
            ])
            ->add('contacts', EntityType::class, [
                'choice_label' => 'code',
                'class' => Contacts::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('targets', EntityType::class, [
                'choice_label' => 'alias',
                'class' => Targets::class,
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
