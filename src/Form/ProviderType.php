<?php

namespace App\Form;

use App\Entity\Provider;
use Faker\Core\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProviderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('businessName', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('dni', TextType::class)
            ->add('cif', TextType::class)
            ->add('address', TextType::class)
            ->add('bankTitleFile',VichFileType::class)
            ->add('managerNif', TextType::class)
            ->add('LOPDdocFile',VichFileType::class)
            ->add('constitutionArticleFile',VichFileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}
