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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('code', TextType::class)
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Belgium' => 'Belgium',
                    'Brazil' => 'Brazil',
                    'China' => 'China',
                    'Congo' => 'Congo',
                    'France' => 'France',
                    'Japan' => 'Japan',
                    'UK' => 'UK',
                    'USA' => 'USA',
                    'Russia' => 'Russia',
                    'Swiss' => 'Swiss',
                ]
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'choice',
                'format' => 'y-M-d',
                'years' => range(date("Y"), 2050)
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'choice',
                'format' => 'y-M-d',
                'years' => range(date("Y"), 2050)
            ])
            ->add('skills', EntityType::class, [
                'choice_label' => 'name',
                'class' => Skills::class,
            ])
            ->add('targets', EntityType::class, [
                'choice_label' => 'alias',
                'class' => Targets::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('agents', EntityType::class, [
                'choice_label' => 'code',
                'class' => Agents::class,
                'multiple' => true,
                'expanded' => true,
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
