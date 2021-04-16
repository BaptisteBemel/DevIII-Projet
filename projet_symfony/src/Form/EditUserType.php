<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            
            
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => ["ROLE_USER"],
                    'Editeur' => ["ROLE_EDITOR"],
                    'Administrateur' => ["ROLE_ADMIN"]
                ],
                'expanded'=>true,
                'label'=>'Rôles',
                'mapped'=>false
            ])
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
