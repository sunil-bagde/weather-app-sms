<?php

namespace App\Domain;

class Temperature
{
    private $temperature;

    public function __construct($temperature)
    {
        if ($this->isValid($temperature)) {
            $this->temperature = $temperature;
        } else {
            throw new \InvalidArgumentException(
                sprintf('The temperature "%s" does not exist.', $temperature)
            );
        }
    }

    /**
     * Determine if this temperature is set.
     * @return bool
     */
    public function isValid(?string $temperature = ''): bool
    {
        if (!empty(trim($temperature))) {
            return true;
        }
        return false;
    }

    /**
     * @param The current temperature (in Celsius).
    */
    public function setTemperature($value = null): void
    {
        $this->temperature = $value;
    }

    /**
       * @param The current temperature (in Celsius).
       * @return float
       */
    public function getTemperature(): ?float
    {
        return $this->temperature;
    }
}
