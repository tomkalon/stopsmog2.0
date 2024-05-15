<?php

namespace App\UI\Controller\FrontPage;

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
        $sensorList = $sensorListQuery->execute();
        $cityList = $cityListQuery->execute();
        $sensorViewList = $settingsViewQuery->execute();
        return $this->render('Main/FrontPage/index.html.twig', [
            'settings' => $sensorViewList,
            'sensorList' => $sensorList,
            'cityList' => $cityList
        ]);
    }
}
