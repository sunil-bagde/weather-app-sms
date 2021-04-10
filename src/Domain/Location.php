<?php

namespace App\Domain;

use App\Exceptions\LocationNotFoundExeption;

class Location
{
    /**
    * The underlying private property .
    *
    * @var string
    */

    private $city = 'Thessaloniki';

    /**
      * Create a new City instance.
      *
      * @param  \App\City  $city
      * @return void
      */
    public function __construct($name)
    {
        if ($this->isValid($name) === true) {
            $this->city = $name;
        } else {
            throw new LocationNotFoundExeption(
                sprintf('The city "%s" does not exist.', $name)
            );
        }
    }

    /**
     * Determine if this city is set.
     *
     * @return bool|exception
     */
    public function isValid(?string $name = ''): bool
    {
        if (!empty(trim($name))) {
            return true;
        }
        return false;
    }

    /**
      * @return string
      */
    public function getCityName(): string
    {
        return $this->city;
    }
}
