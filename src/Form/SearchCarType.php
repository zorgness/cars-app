<?php

namespace App\Form;

use App\Entity\SearchCar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SearchCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minYear', IntegerType::class, [
              "required" => false,
              "label" => "form year"
            ])
            ->add('maxYear', IntegerType::class, [
              "required" => false,
              "label" => "to year"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchCar::class,
        ]);
    }
}
