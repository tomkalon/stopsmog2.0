<?php

namespace App\UI\Controller\City;

use App\Domain\Filter\Sensor\SensorFilter;
use App\Infrastructure\Query\City\GetCityViewInterface;
use App\Infrastructure\Query\Sensor\GetSensorListInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CityController extends AbstractController
{
    public function show(
        GetCityViewInterface $cityViewQuery,
        GetSensorListInterface $sensorListQuery,
        int $id
    ): Response
    {
        $cityView = $cityViewQuery->execute($id);
        $sensorList = $sensorListQuery->execute(
            new SensorFilter(
                true,
                $cityView->getId()
            )
        );
        return $this->render('Main/City/show.html.twig', [
            'city' => $cityView,
            'sensorList' => $sensorList,
        ]);
    }
}
