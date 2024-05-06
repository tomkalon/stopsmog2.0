<?php

namespace App\UI\Web\Controller\Sensor;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SensorController extends AbstractController
{
    public function show(): Response
    {
        return $this->render('Main/Sensor/show.html.twig');
    }
}
