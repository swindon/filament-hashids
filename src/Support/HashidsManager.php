<?php

namespace Swindon\FilamentHashids\Support;

use Hashids\Hashids;

class HashidsManager
{
    protected static $instance;

    /**
     * Instantiate the Hashids instance with config values.
     */
    protected static function instance()
    {
        if (!isset(self::$instance)) {
            $salt = config('filament-hashids.salt', config('app.key'));
            $minLength = config('filament-hashids.min_length', 8);
            $alphabet = config('filament-hashids.alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
            self::$instance = new Hashids($salt, $minLength, $alphabet);
        }
        return self::$instance;
    }

    /**
     * Encode an ID into a Hashid.
     */
    public static function encode($id)
    {
        return self::instance()->encode($id);
    }

    /**
     * Decode a Hashid back into an ID.
     */
    public static function decode($hash)
    {
        $decoded = self::instance()->decode($hash);
        return $decoded;
    }
}
