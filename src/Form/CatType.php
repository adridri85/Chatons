<?php

namespace App\Form;

use App\Entity\Cat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' , TextType::class,[
                'label' => "Quelle est le nom ?"
            ])
            ->add('picture', FileType::class, [
                'mapped' => false,
            ])
            ->add('description', TextType::class, [
                'label' => "le description de l'image ?",
            ])
            ->add('price', NumberType::class,[
                'label' => "quel prix ?"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cat::class,
        ]);
    }
}
