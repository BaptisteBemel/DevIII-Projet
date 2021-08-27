<?php 

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class CommentTest extends KernelTestCase
{
    /*public function getEntity() : Comment{
        return (new Comment())
        ->setAuthor("Arthur Schamroth")
        ->setContent("Bonjour je suis un test")
        ->setCreatedAt(new DateTime());
    }

    public function assertHasErrors(Comment $code, int $number=0){
        self::bootKernel();
        $error = self::$container->get("validator")->validate($code);
        $this->assertCount($number, $error);
    }

    public function testValid(){
        $this->assertHasErrors($this->getEntity(), 0); 
    }*/
}