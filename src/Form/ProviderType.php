<?php

namespace App\Form;

use App\Entity\Provider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bussinessName', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('dni', TextType::class)
            ->add('cif', TextType::class)
            ->add('address', TextType::class)
            ->add('bankTitle')
            ->add('managerNif', TextType::class)
            ->add('LOPDdoc')
            ->add('constitutionArticle')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}
