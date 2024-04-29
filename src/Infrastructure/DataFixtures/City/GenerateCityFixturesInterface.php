<?php

namespace App\Infrastructure\DataFixtures\City;

use App\Domain\Entity\City;

interface GenerateCityFixturesInterface
{
    public function getCity(): ?City;
}
