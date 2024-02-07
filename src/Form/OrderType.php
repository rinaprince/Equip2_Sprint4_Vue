<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('state')

            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'name',
            ])

            ->add('vehicles', EntityType::class, [
                'class' => Vehicle::class,
                'choice_label' => 'brand.name',
                'multiple' => true,
            ])

            ->add('vehicles', EntityType::class, [
                'class' => Vehicle::class,
                'choice_label' => 'model.name',
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
