<?php

namespace App\Application\Command\Settings;

use App\Application\Service\CQRS\Command\CommandInterface;
use App\Domain\View\Settings\SettingsView;

readonly class SettingsCommand implements CommandInterface
{
    public function __construct(
        private SettingsView $settingsView,
    ) {
    }

    public function getSettingsView(): SettingsView
    {
        return $this->settingsView;
    }
}
