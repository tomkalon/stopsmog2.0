<?php

namespace App\Application\Command\Sensor;

use App\Application\Service\CQRS\Command\CommandInterface;
use App\Domain\View\Sensor\SensorView;

readonly class RemoveSensorCommand implements CommandInterface
{
    public function __construct(
        private string $id
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
