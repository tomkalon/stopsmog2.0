<?php

namespace App\UI\Web\Controller\City;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CityController extends AbstractController
{
    public function show(
        int $id
    ): Response
    {
        return $this->render('Main/City/show.html.twig', [

        ]);
    }
}
