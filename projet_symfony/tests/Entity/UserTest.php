<?php 

namespace App\Tests\Entity;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UserTest extends KernelTestCase
{

    public function getEntity() : User{
        return (new User())
        ->setEmail("test@gmail.com")
        ->setNom("NomTest")
        ->setPrenom("PrenomTest")
        ->setAdresse("Rue du Test n°1")
        ->setNumeroTel("0411 11 11 11") 
        ->setSituationScolaire("Je suis un test à l'école")
        ->setRoles(array('ROLE_USER'))
        ->setPassword("123456789");
    }

    public function assertHasErrors(User $code, int $number=0){
        self::bootKernel();
        $error = self::$container->get("validator")->validate($code);
        $this->assertCount($number, $error);
    }

    public function testValid(){
        $this->assertHasErrors($this->getEntity(), 0); 
    }

    public function testInvalidPassword(){
        $this->assertHasErrors($this->getEntity()->setPassword(" "), 1);
        $this->assertHasErrors($this->getEntity()->setPassword("123"), 1);
    }

    public function testInvalidEmail(){
        $this->assertHasErrors($this->getEntity()->setEmail(" "), 1);
        $this->assertHasErrors($this->getEntity()->setEmail("schamrothgmail.com"), 1);
    }

    public function testInvalidPrenom(){
        $this->assertHasErrors($this->getEntity()->setPrenom(" "), 1);
        $this->assertHasErrors($this->getEntity()->setPrenom("Arthur1"), 1);
    }

    public function testInvalidNom(){
        $this->assertHasErrors($this->getEntity()->setNom(" "), 1);
        $this->assertHasErrors($this->getEntity()->setNom("Schamroth1"), 1);
    }

    public function testInvalidAdresse(){
        $this->assertHasErrors($this->getEntity()->setAdresse("Rue de l'"), 1);
        $this->assertHasErrors($this->getEntity()->setAdresse("  "), 3);
    }

    public function testInvalidNumero(){
        $this->assertHasErrors($this->getEntity()->setNumeroTel("a0471.01.01.01"), 1);
        $this->assertHasErrors($this->getEntity()->setNumeroTel("0471.01.01.01a"), 1);
        $this->assertHasErrors($this->getEntity()->setNumeroTel("04"), 1);
    }
    
}