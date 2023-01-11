<?php

namespace App\Form;

use App\Entity\Chercheur;
use App\Entity\Faculte;
use App\Entity\Laboratoire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChercheurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chnom')
            ->add('grade', ChoiceType::class,['choices'=>[
                'Etudiant'=>'E',
                'Doctorant'=>'D',
                'Assistant'=>'A',
                'Maître Assistant'=>'MA',
                'Maître de conférence'=>'MC',
                'Professeur'=>'PR'
            ]])
            ->add('status', ChoiceType::class,['choices'=>[
                'Permanent'=>'P',
                'Contractuel'=>'C'
            ]])
            ->add('daterecrut')
            ->add('salaire')
            ->add('prime')
            ->add('email',EmailType::class)
            ->add('supno',EntityType::class,[
                'class'=>Chercheur::class,
                'placeholder' => 'Choose an option',
                'required' => false,
                'choice_label' => 'chnom','label'=>'Suppérviseur'
            ])
            ->add('labno',EntityType::class,[
                'class'=>Laboratoire::class,
                'choice_label' => 'labnom','label'=>'Laboratoire'
            ])
            ->add('facno',EntityType::class,[
                'class'=>Faculte::class,
                'choice_label' => 'facnom','label'=>'Faculté'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chercheur::class,
        ]);
    }
}
