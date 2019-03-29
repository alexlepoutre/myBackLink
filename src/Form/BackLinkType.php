<?php

namespace App\Form;

use App\Entity\BackLink;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class BackLinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mySite')
            ->add('hisSite')
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime("now"),
            ])
 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BackLink::class,
        ]);
    }
}
