<?php

namespace App\Application\Service\CQRS\Query;

interface QueryBusInterface
{
    public function handle(QueryInterface $query): mixed;
}
