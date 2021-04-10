<?php

namespace App\Contracts;

interface Client
{
    public function fetch(string $url): ?string;
}
