<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Skills;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class AgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName')
            ->add('firstName')
            ->add('birthday')
            ->add('code')
            ->add('nationality')
            ->add('skills', EntityType::class, [
                'choice_label' => 'name',
                'class' => Skills::class,
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Agents::class,
        ]);
    }
}
