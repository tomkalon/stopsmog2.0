<?php

namespace App\Application\Service\Settings;

use App\Domain\ValueObject\File\FileVo;
use App\Domain\View\Settings\SettingsView;

interface UpdateSettingsInterface
{
    public function persist(SettingsView $settingsView, ?FileVo $fileVo);
}
