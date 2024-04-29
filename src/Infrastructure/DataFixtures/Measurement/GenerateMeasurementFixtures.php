<?php

namespace App\Infrastructure\DataFixtures\Measurement;

use App\Domain\Entity\Measurement;
use App\Domain\Entity\Sensor;
use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

readonly class GenerateMeasurementFixtures implements GenerateMeasurementFixturesInterface
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    /**
     * @throws Exception
     */
    public function addMeasurement(Sensor $sensor, int $count, int $interval): void
    {
        $measurement = [];
        $pm10 = 25;
        $pm25 = 10;

        $numberOfMinutesToSubtract = $count * $interval;
        $currentDateTime = new DateTimeImmutable();
        $time = $currentDateTime->sub(new DateInterval('PT' . $numberOfMinutesToSubtract . 'M'));

        for ($i = 0; $i < $count; $i++) {
            $measurement[$i] = new Measurement();
            $measurement[$i]->setSensor($sensor);
            $measurement[$i]->setPm10($pm10);
            $measurement[$i]->setPm25($pm25);
            $measurement[$i]->setCreatedAt($time);
            $this->em->persist($measurement[$i]);

            $pm10 = $this->generateRandomValue($pm10, 10, 3, 400);
            $pm25 = $this->generateRandomValue($pm25, 5, 1, 300);
            $time = $time->add(new DateInterval('PT' . $interval . 'M'));
        }

        $this->em->flush();
    }

    private function generateRandomValue(
        int $value,
        int $scope,
        int $min,
        int $max,
    ): int
    {
        $difference = rand(0, $scope);
        $trend = rand(0, 1);

        if ($trend) {
            $value += $difference;
            if ($value > $max) {
                $value -= (2 * $difference);
            }
        } else {
            $value -= $difference;
            if ($value < $min) {
                $value += (2 * $difference);
            }
        }

        return $value;
    }

}
