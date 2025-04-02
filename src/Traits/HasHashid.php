<?php

namespace Swindon\FilamentHashids\Traits;

use Swindon\FilamentHashids\Support\HashidsManager;

trait HasHashid
{
    /**
     * Returns the Hashid encoded version of the model's key.
     */
    public function getHashid()
    {
        return HashidsManager::encode($this->getKey());
    }

    public function getRouteKey()
    {
        return $this->getHashid();
    }
}
