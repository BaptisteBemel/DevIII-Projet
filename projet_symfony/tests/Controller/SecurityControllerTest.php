<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class SecurityControllerTest extends WebTestCase{
    public function testDisplayLogin(){
        $client = static::createClient();
        $client->request("GET", "/connexion");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorTextContains("h1", "Connexion");
    }

    public function testDisplayRegistration(){
        $client = static::createClient();
        $client->request("GET", "/inscription");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testLoginWithBadCredentials(){
        $client = static::createClient();
        $crawler = $client->request("GET", "/connexion");
        $form = $crawler->selectButton("Connexion")->form([
            '_username'=>"schamrotharthur@gmail.com",
            '_password'=>"fakepassword",
        ]);
        $client->submit($form);
        $this->assertResponseRedirects();
        $client->followRedirect();
    }

    public function testLoginWithCorrectCredentials(){
        $client = static::createClient();
        $crawler = $client->request("GET", "/connexion");
        $form = $crawler->selectButton("Connexion")->form([
            '_username'=>"schamrotharthur@gmail.com",
            '_password'=>"123456789",
        ]);
        $client->submit($form);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorNotExists(".alert.alert-danger");
    }

    public function testSuccessfullLogin(){
        $client = static::createClient();
        $csrfToken = $client->getContainer()->get('security.csrf.token_manager')->getToken('user');
        $client->request('POST', '/connexion',[
        '_csrf_token'=>$csrfToken,
        '_username'=>'schamrotharthur@gmail.com',
        '_password'=>'123456789']);
        $this->assertResponseRedirects();
        $client->followRedirect("/");
        $this->assertSelectorNotExists(".alert.alert-danger");
    }
}