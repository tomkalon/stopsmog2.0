<?php

namespace App\UI\Controller\Sensor;

use App\Application\DTO\Sensor\SensorDto;
use App\Domain\Entity\Measurement;
use App\Domain\Filter\Sensor\SensorFilter;
use App\Infrastructure\Query\Sensor\GetSensorView;
use DateTimeImmutable;
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
            new SensorFilter(
                timePeriodStart: new DateTimeImmutable('today midnight')
            )
        );

        return $this->render('Main/Sensor/show.html.twig', [
            'sensor' => $sensorView
        ]);
    }
}
