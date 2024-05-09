<?php

namespace App\Infrastructure\Form\Settings;

use App\Domain\View\Settings\SettingsView;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('map_image', FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'ui.buttons.update',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SettingsView::class,
            'allow_extra_fields' => false,
            'method' => 'POST',
            'csrf_protection' => true,
            'label_format' => 'ui.settings.%name%',
        ]);
    }
}
