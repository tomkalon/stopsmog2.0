<?php

namespace App\UI\Web\Controller\Settings;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends AbstractController
{
    public function edit(): Response
    {
        return $this->render('Admin/Settings/edit.html.twig', [

        ]);
    }
}
