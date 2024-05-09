<?php

namespace App\UI\Controller\Settings;

use App\Infrastructure\Query\Settings\GetSettingsViewInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends AbstractController
{
    public function edit(
        GetSettingsViewInterface $settingsViewQuery
    ): Response
    {
        $settingsView = $settingsViewQuery->execute();
        return $this->render('Admin/Settings/edit.html.twig', [

        ]);
    }
}
