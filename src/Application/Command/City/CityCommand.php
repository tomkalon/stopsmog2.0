<?php

namespace App\Application\Command\City;

use App\Application\Service\CQRS\Command\CommandInterface;
use App\Domain\View\City\CityView;

readonly class CityCommand implements CommandInterface
{
    public function __construct(
        private CityView $cityView
    )
    {
    }

    public function getCityView(): CityView
    {
        return $this->cityView;
    }

}
