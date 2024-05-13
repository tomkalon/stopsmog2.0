<?php

namespace App\Infrastructure\Query\Settings;

use App\Domain\Repository\SettingsRepositoryInterface;
use App\Domain\View\Settings\SettingsView;

readonly class GetSettingsView implements GetSettingsViewInterface
{
    public function __construct(
        private SettingsRepositoryInterface $settingsRepository
    )
    {
    }

    public function execute(): SettingsView
    {
        $settings = $this->settingsRepository->find('settings');
        if ($settings) {
            return SettingsView::fromEntity($settings);
        } else {
            return new SettingsView();
        }
    }
}
