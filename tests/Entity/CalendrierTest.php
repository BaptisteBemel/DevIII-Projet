<?php 

namespace App\Tests\Entity;
use App\Entity\Calendrier;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class CalendrierTest extends KernelTestCase
{
    public function getEntity() : Calendrier{
        return (new Calendrier())
        ->setDateRdv(json_decode("2021-08-27 16:54:00"))
        ->setMatiere("sciences")
        ->setStatut("occupé")
        ->setId("1");
    }
}
