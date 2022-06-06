<?php

namespace App\Form;

use App\Entity\Etablissements;
use App\Entity\Gerants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

        class EtablissementsType extends AbstractType
        {
            public function buildForm(FormBuilderInterface $builder, array $options): void
            {
                $builder
                    ->add('nom')
                    ->add('ville')
                    ->add('adresse')
                    ->add('description', TextType::class)
                    ->add('gerant', EntityType::class, [
                        'class' => Gerants::class])
                    ->add('images', FileType::class,[
                        'label' => false,
                        'multiple' => true,
                        'mapped' => false,
                        'required' => false
                    ])
                ;
            }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etablissements::class,
        ]);
    }
}
