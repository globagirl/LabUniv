<?php

namespace App\Form;

use App\Entity\Publication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('theme', ChoiceType::class,['choices'=>[
                'informatique'=>'informatique',
                'science'=>'science',
                'droit'=>'droit',
                'mathematique'=>'mathematique',
                'autre'=>'autre'
            ]])
            ->add('typepub', ChoiceType::class,['choices'=>[
                'AS'=>'Article Scientifique',
                'PC'=>'Présentation en colloque',
                'P'=>'Poster',
                'L'=>'Livre',
                'T'=>'Thèse',
                'M'=>'Mémoire de Mastère'
            ]])
            ->add('volume')
            ->add('datepub',DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('apparition')
            ->add('editeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Publication::class,
        ]);
    }
}
