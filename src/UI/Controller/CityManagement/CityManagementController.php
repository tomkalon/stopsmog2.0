<?php

namespace App\UI\Controller\CityManagement;

use App\Application\Command\City\CityCommand;
use App\Application\Service\CQRS\Command\CommandBusInterface;
use App\Domain\View\City\CityView;
use App\Infrastructure\Form\City\CityType;
use App\Infrastructure\Query\City\GetCityListInterface;
use App\Infrastructure\Query\City\GetCityViewInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CityManagementController extends AbstractController
{
    public function index(
        GetCityListInterface $cityListQuery
    ): Response
    {
        $cityViewList = $cityListQuery->execute();
        return $this->render('Admin/CityManagement/index.html.twig', [
            'cities' => $cityViewList
        ]);
    }

    public function show(
        GetCityViewInterface $cityViewQuery,
        int $id
    ): Response
    {
        $cityView = $cityViewQuery->execute($id);
        return $this->render('Admin/CityManagement/show.html.twig', [
            'city' => $cityView
        ]);
    }

    public function create(
        CommandBusInterface $commandBus,
        Request $request,
    ): Response
    {
        $form = $this->createForm(CityType::class, new CityView());
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            /** @var CityView $cityView */
            $cityView = $form->getData();
            $commandBus->dispatch(new CityCommand($cityView));
            return $this->redirectToRoute('admin_web_city_index');
        }

        return $this->render('Admin/CityManagement/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function update(
        GetCityViewInterface $cityViewQuery,
        CommandBusInterface $commandBus,
        Request $request,
        int $id
    ): Response
    {
        $cityView = $cityViewQuery->execute($id);
        $form = $this->createForm(CityType::class, $cityView);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {

            /** @var CityView $cityView */
            $cityView = $form->getData();
            $cityView->setId($id);
            $cityView->setUploadedFile($form->get('map')->getData());
            $commandBus->dispatch(new CityCommand($cityView));
            return $this->redirectToRoute('admin_web_city_show', ['id' => $id]);
        }

        return $this->render('Admin/CityManagement/update.html.twig', [
            'form' => $form->createView(),
            'city' => $cityView
        ]);
    }
}
