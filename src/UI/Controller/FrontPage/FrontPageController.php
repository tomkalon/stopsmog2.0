<?php

namespace App\UI\Controller\FrontPage;

use App\Domain\Filter\Sensor\SensorFilter;
use App\Infrastructure\Query\City\GetCityListInterface;
use App\Infrastructure\Query\Sensor\GetSensorListInterface;
use App\Infrastructure\Query\Settings\GetSettingsViewInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontPageController extends AbstractController
{
    public function index(
        GetSensorListInterface $sensorListQuery,
        GetCityListInterface $cityListQuery,
        GetSettingsViewInterface $settingsViewQuery
    ): Response
    {
        $cityList = $cityListQuery->execute();
        $settingsView = $settingsViewQuery->execute();
        $sensorList = $sensorListQuery->execute(
            new SensorFilter(
                true
            )
        );

        return $this->render('Main/FrontPage/index.html.twig', [
            'settings' => $settingsView,
            'sensorList' => $sensorList,
            'cityList' => $cityList
        ]);
    }
}
