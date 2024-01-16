<?php

namespace App\Form;

use App\Entity\Model;
use App\Entity\Order;
use App\Entity\Provider;
use App\Entity\Vehicle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Vehicle1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plate')
            ->add('observedDamages')
            ->add('kilometers')
            ->add('buyPrice')
            ->add('sellPrice')
            ->add('fuel')
            ->add('iva')
            ->add('description')
            ->add('chassisNumber')
            ->add('gearShit')
            ->add('isNew')
            ->add('transportIncluded')
            ->add('color')
            ->add('registrationDate')
            ->add('model', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'name',
            ])
            ->add('provider', EntityType::class, [
                'class' => Provider::class,
                'choice_label' => 'bussinessname',

            ])
            ->add('vehicleOrder', EntityType::class, [
                'class' => Order::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
