<?php

namespace App\Domain\Enum;

enum PeriodEnum: string
{
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case YEAR = 'year';
}
