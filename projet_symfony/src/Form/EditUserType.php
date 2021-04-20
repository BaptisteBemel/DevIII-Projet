<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,
            ['constraints' =>[
                new NotBlank(['message' => 'Veuillez entrer le nouveau nom !',])],
            'required'=>true,
            'attr' => ['class'=>'form-control'],])


            ->add('prenom', TextType::class,
            ['constraints' =>[
                new NotBlank(['message' => 'Veuillez entrer le nouveau prenom !',])],
            'required'=>true,
            'attr' => ['class'=>'form-control'],])


            ->add('nom', TextType::class,
            ['constraints' =>[
                new NotBlank(['message' => 'Veuillez entrer la nouvelle situation scolaire !',])],
            'required'=>true,
            'attr' => ['class'=>'form-control'],])
            
            ->add($builder->create('roles', ChoiceType::class, array(
                'multiple'=>true,
                'expanded'=>true,
                'choices'=> array('ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER'=>'ROLE_USER')
            ))
            )
            
            ->add('Valider', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
