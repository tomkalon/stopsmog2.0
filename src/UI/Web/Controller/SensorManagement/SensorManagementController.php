<?php

namespace App\UI\Web\Controller\SensorManagement;

use App\Application\Command\Sensor\SensorCommand;
use App\Application\Service\CQRS\Command\CommandBusInterface;
use App\Domain\View\Sensor\SensorView;
use App\Infrastructure\Form\Sensor\SensorType;
use App\Infrastructure\Query\Sensor\GetSensorListInterface;
use App\Infrastructure\Query\Sensor\GetSensorViewInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorManagementController extends AbstractController
{
    public function index(
        GetSensorListInterface $sensorListQuery
    ): Response
    {
        $sensorViewList = $sensorListQuery->execute();
        return $this->render('Admin/SensorManagement/index.html.twig', [
            'sensors' => $sensorViewList
        ]);
    }

    public function show(
        GetSensorViewInterface $sensorViewQuery,
        int $id
    ): Response
    {
        $sensorView = $sensorViewQuery->execute($id);
        return $this->render('Admin/SensorManagement/show.html.twig', [
            'sensor' => $sensorView
        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request $request,
    ): Response
    {
        $form = $this->createForm(SensorType::class, new SensorView());
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            /** @var SensorView $sensorView */
            $sensorView = $form->getData();
            $commandBus->dispatch(new SensorCommand($sensorView));
            return $this->redirectToRoute('admin_web_sensor_index');
        }

        return $this->render('Admin/SensorManagement/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function update(
        GetSensorViewInterface $sensorViewQuery,
        CommandBusInterface $commandBus,
        Request $request,
        int $id
    ): Response
    {
        $sensorView = $sensorViewQuery->execute($id);
        $form = $this->createForm(SensorType::class, $sensorView);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            /** @var SensorView $sensorView */
            $sensorView = $form->getData();
            $sensorView->setId($id);
            $commandBus->dispatch(new SensorCommand($sensorView));
            return $this->redirectToRoute('admin_web_sensor_show', ['id' => $id]);
        }

        return $this->render('Admin/SensorManagement/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
