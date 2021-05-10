<?php 

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase; 

class PageControllerTest extends WebTestCase{

    public function testHelloPage(){
        $client = static::createClient();
        $client->request("GET", "/");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function selectorLoginTest(){
        $client = static::createClient();
        $client->request("GET", "/connexion");
        $this->assertSelectorTextContains("h1", "Connexion");
    }
}