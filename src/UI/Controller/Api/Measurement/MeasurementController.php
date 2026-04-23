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

    public function rangeGet(Request $request): JsonResponse
    {
        $sensorId = $request->query->get('sensor');
        $fromStr  = $request->query->get('from');
        $toStr    = $request->query->get('to');

        if (!$sensorId || !$fromStr || !$toStr) {
            return $this->json(['error' => 'Missing required parameters: sensor, from, to'], 400);
        }

        try {
            $from = new \DateTimeImmutable($fromStr);
            $to   = (new \DateTimeImmutable($toStr))->setTime(23, 59, 59);
        } catch (\Exception) {
            return $this->json(['error' => 'Invalid date format'], 400);
        }

        if ($from > $to) {
            return $this->json(['error' => 'Parameter "from" must be before "to"'], 400);
        }

        $days = (int) $from->diff($to)->days;
        $granularity = match (true) {
            $days <= 3  => '1h',
            $days <= 14 => '4h',
            $days <= 60 => '1d',
            default     => '1w',
        };

        $items = $this->measurementRepository->getRangeAggregated($sensorId, $from, $to);

        return $this->json(['items' => $items, 'granularity' => $granularity, 'days' => $days]);
    }
}
