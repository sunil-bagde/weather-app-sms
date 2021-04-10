<?php

namespace App\Contracts;

use App\Domain\Location;
use App\Domain\Temperature;

interface Weatherable
{
    public function getWeather(Location $location) : ?Temperature;
}
