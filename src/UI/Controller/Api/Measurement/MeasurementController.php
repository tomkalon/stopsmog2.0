<?php

namespace App\UI\Controller\Api\Measurement;

use App\Domain\Repository\MeasurementRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MeasurementController extends AbstractController
{
    public function __construct(
        private readonly MeasurementRepositoryInterface $measurementRepository
    ) {
    }

    public function weeklyGet(Request $request): JsonResponse
    {
        $sensorId = $request->query->get('sensor');

        if (!$sensorId) {
            return $this->json(['error' => 'Missing sensor parameter'], 400);
        }

        $items = $this->measurementRepository->getWeeklyAggregated($sensorId);

        return $this->json(['items' => $items]);
    }

    public function monthlyGet(Request $request): JsonResponse
    {
        $sensorId = $request->query->get('sensor');

        if (!$sensorId) {
            return $this->json(['error' => 'Missing sensor parameter'], 400);
        }

        $items = $this->measurementRepository->getMonthlyAggregated($sensorId);

        return $this->json(['items' => $items]);
    }
}
