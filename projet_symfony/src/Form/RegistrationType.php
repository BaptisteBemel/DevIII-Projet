<?php

namespace App\Form;

use App\Entity\User;
use Bundle\RecaptchaBundle\Type\RecaptchaSubmitType;
use Doctrine\DBAL\Types\JsonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('numero_tel')
            ->add('situationscolaire')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)

        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
