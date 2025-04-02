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

    /**
     * Returns the Hashid decoded version of the model's key for route binding.
     */
    public function getRouteKey()
    {
        return $this->getHashid();
    }

    /**
     * Scope for querying models by their Hashid.
     */
    public function scopeWhereHashid($query, $hashid)
    {
        $decoded = HashidsManager::decode($hashid);

        if (empty($decoded)) {
            return $query->whereRaw('1 = 0');
        }

        return $query->whereKey($decoded[0]);
    }

    /**
     * Scope for finding a model by its Hashid.
     */
    public function scopeFindHashid($query, $hashid)
    {
        $decoded = HashidsManager::decode($hashid);

        if (empty($decoded)) {
            return null;
        }

        return $query->find($decoded[0]);
    }
}
