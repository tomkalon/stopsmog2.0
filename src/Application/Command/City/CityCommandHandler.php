<?php

namespace App\Application\Command\City;

use App\Application\Service\City\CreateCityService;
use App\Application\Service\City\UpdateCityService;
use App\Application\Service\CQRS\Command\CommandHandlerInterface;
use Exception;

readonly class CityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateCityService $createCityService,
        private UpdateCityService $updateCityService
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(CityCommand $command): void
    {
        $cityView = $command->getCityView();
        if ($cityView->getId()) {
            $this->updateCityService->save($cityView);
        } else {
            $this->createCityService->save($cityView);
        }
    }
}
