<?php

namespace App\UI\Controller\Settings;

use App\Application\Command\Settings\SettingsCommand;
use App\Application\Service\CQRS\Command\CommandBusInterface;
use App\Domain\View\Settings\SettingsView;
use App\Infrastructure\Form\Settings\SettingsType;
use App\Infrastructure\Query\Settings\GetSettingsViewInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends AbstractController
{
    public function edit(
        GetSettingsViewInterface $settingsViewQuery,
        CommandBusInterface $commandBus,
        Request $request
    ): Response
    {
        $settingsView = $settingsViewQuery->execute();
        $form = $this->createForm(SettingsType::class, $settingsView);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            /** @var SettingsView $settingsData */
            $settingsData = $form->getData();
            $mapImage = $form->get('mapImage')->getData();
            $commandBus->dispatch(new SettingsCommand($settingsData, $mapImage));
            return $this->redirectToRoute('admin_web_settings_edit');
        }

        return $this->render('Admin/Settings/edit.html.twig', [
            'settings' => $settingsView,
            'form' => $form->createView(),
        ]);
    }
}
