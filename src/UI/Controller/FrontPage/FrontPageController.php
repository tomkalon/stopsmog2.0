<?php

namespace App\UI\Controller\FrontPage;

use App\Infrastructure\Query\Sensor\GetSensorListInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontPageController extends AbstractController
{
    public function index(
        GetSensorListInterface $sensorListQuery
    ): Response
    {
        $sensorList = $sensorListQuery->execute();
        return $this->render('Main/FrontPage/index.html.twig', [
            'sensorList' => $sensorList
        ]);
    }
}
