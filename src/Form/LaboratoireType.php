<?php

namespace App\Form;

use App\Entity\Faculte;
use App\Entity\Laboratoire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LaboratoireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('labnom')
            ->add('facno',EntityType::class,[
                'class'=>Faculte::class,
                'choice_label' => 'facnom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Laboratoire::class,
        ]);
    }
}
