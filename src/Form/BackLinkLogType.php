<?php

namespace App\Form;

use App\Entity\BackLink;
use App\Entity\BackLinkLog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BackLinkLogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt')
            ->add('foundIt')
            ->add('logText')
            ->add('BackLink', EntityType::class, [
                'class' => BackLink::class,
                'choice_label' => 'mySite',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BackLinkLog::class,
        ]);
    }
}
