<?php

namespace App\Form;

use App\Entity\Depot;
use Symfony\Component\Form\AbstractType;        
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DepotType extends AbstractType
{
    public function findOneByEmail($email)
    {
    $q = $this->createQueryBuilder('c')
        ->where('c.email = :email')
        ->setParameter('email', $email)
        ->getQuery();
    return $q->getOneOrNullResult(); 
    }
}
