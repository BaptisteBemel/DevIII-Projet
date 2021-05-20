<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class espaceEleveControllerTest extends WebTestCase{

    public function testDisplayEspaceEleve(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_eleve");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayProfilEleve(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_eleve/profil_eleve");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayModifProfil(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_eleve/profil_eleve/modif_profil");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayModifMdp(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_eleve/profil_eleve/modif_mdp");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayRessources(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_eleve/ressources");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDisplayMessagerieEleve(){
        $client = static::createClient();
        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('schamrotharthur@gmail.com');
        $client->loginUser($testUser);
        $client->request("GET", "/espace_eleve/messagerie_eleve");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
