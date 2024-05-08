<?php

namespace App\Domain\Entity;


namespace App\Domain\Entity;

use App\Domain\Trait\LifecycleTrait;

class Settings
{
    use LifecycleTrait;

    private string $id = 'settings';

    public function getId(): string
    {
        return $this->id;
    }
}
