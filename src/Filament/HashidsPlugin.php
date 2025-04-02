<?php

namespace Swindon\FilamentHashids\Filament;

use Filament\PluginServiceProvider;

class HashidsPlugin extends PluginServiceProvider
{
    /**
     * Optionally, override or extend Filament resource routes here.
     */
    public static function getRoutes(): array
    {
        return [
            // Developers can override routes if needed
        ];
    }

    /**
     * Provide route middleware for Filament resources.
     */
    public static function getRouteMiddleware(): array
    {
        return [
            'decode-hashids' => \Swindon\FilamentHashids\Middleware\DecodeHashidsMiddleware::class,
        ];
    }
}
