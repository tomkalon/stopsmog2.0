<?php

namespace App\UI\Controller\FrontPage;

use App\Infrastructure\Query\Sensor\GetSensorListInterface;
use App\Infrastructure\Query\Settings\GetSettingsViewInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontPageController extends AbstractController
{
    public function index(
        GetSensorListInterface $sensorListQuery,
        GetSettingsViewInterface $settingsViewQuery
    ): Response
    {
        $sensorList = $sensorListQuery->execute();
        $settingsView = $settingsViewQuery->execute();
        return $this->render('Main/FrontPage/index.html.twig', [
            'settings' => $settingsView,
            'sensorList' => $sensorList
        ]);
    }
}
