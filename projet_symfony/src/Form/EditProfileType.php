<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ["attr"=>["class"=>"form-control"]])
            ->add('prenom', TextType::class, ["attr"=>["class"=>"form-control"]])
            ->add('adresse', TextType::class, ["attr"=>["class"=>"form-control"]])
            ->add('numero_tel', TextType::class, ["attr"=>["class"=>"form-control"]])
            ->add('situationscolaire', TextareaType::class, ["attr"=>["class"=>"form-control"]])
            ->add('valider', SubmitType::class, ["attr"=>["class"=>"btn btn-primary"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
