<?php

namespace Tests;

use App\Domain\Location;
use PHPUnit\Framework\TestCase;
use App\Exceptions\LocationNotFoundExeption;

class LocationTest extends TestCase
{
    public function test_it_checks_city_name_set_or_not()
    {
        $name = 'Mumbai';
        $city = new Location($name);
        $this->assertEquals($name, $city->getCityName());
    }
}
