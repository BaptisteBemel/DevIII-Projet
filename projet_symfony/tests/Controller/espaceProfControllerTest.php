<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class espaceProfControllerTest extends WebTestCase{

    public function testDisplayEspaceProf(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayProfilsEleves(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/profils_eleves");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayProfilsElevesPrenom(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/profils_eleves_prenom");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayProfilsElevesNom(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/profils_eleves_nom");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayAdminUsers(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/utilisateurs");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayMessagerieProf(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/messagerie_prof");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayAdminSite(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/administration_site");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayCommentaires(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/commentaires");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayEnvoiRessources(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_prof/envoi_fichier");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}