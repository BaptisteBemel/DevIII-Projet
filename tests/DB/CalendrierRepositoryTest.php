<?php 

namespace App\Tests\DB; 

use App\Repository\CalendrierRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CalendrierRepositoryTest extends KernelTestCase
{
    public function testCountDate(){
        self::bootKernel();
        $dates = self::$container->get(CalendrierRepository::class)->count([]);
        $this->assertEquals(2, $dates);
    }
}