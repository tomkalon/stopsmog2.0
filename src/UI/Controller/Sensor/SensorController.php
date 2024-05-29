<?php

namespace App\UI\Controller\Sensor;

use App\Infrastructure\Query\Sensor\GetSensorView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SensorController extends AbstractController
{
    public function show(
        GetSensorView $getSensorViewQuery,
        string $id
    ): Response {
        $sensorView = $getSensorViewQuery->execute(
            $id,

        );
        return $this->render('Main/Sensor/show.html.twig', [
            'sensor' => $sensorView
        ]);
    }
}
