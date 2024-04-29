<?php

namespace App\Domain\Trait;


trait IdTrait
{
    private int $id;

    public function setId(): string
    {
        return $this->id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
