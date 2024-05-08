<?php

namespace App\Infrastructure\Query\Settings;

use App\Domain\View\Settings\SettingsView;

interface GetSettingsViewInterface
{
    public function execute(): SettingsView;
}
