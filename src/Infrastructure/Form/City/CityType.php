<?php

namespace App\Infrastructure\Form\City;

use App\Domain\View\City\CityView;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new Length(['min' => 3]),
                ]
            ])
            ->add('positionX', IntegerType::class, [
                'constraints' => [
                    new Length(['min' => 1, 'max' => 4]),
                ]
            ])
            ->add('positionY', IntegerType::class, [
                'constraints' => [
                    new Length(['min' => 1, 'max' => 4]),
                ]
            ])
            ->add('submit', SubmitType::class, [
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CityView::class,
            'allow_extra_fields' => false,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.city.%name%',
        ]);
    }

}
