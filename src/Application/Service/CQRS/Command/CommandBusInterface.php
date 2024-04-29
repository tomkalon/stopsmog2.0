<?php

namespace App\Application\Service\CQRS\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
