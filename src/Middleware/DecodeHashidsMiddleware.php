<?php

namespace Swindon\FilamentHashids\Middleware;

use Closure;
use Illuminate\Http\Request;
use Swindon\FilamentHashids\Support\HashidsManager;

class DecodeHashidsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();

        if ($route) {
            $parameters = $route->parameters();

            foreach ($parameters as $key => $value) {
                if (is_string($value)) {
                    $decoded = HashidsManager::decode($value);
                    if (is_array($decoded) && count($decoded) > 0) {
                        // Replace the hashed parameter with the actual ID.
                        $route->setParameter($key, $decoded[0]);
                    }
                }
            }
        }

        return $next($request);
    }
}
