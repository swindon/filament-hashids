<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\TestCase;
use Swindon\FilamentHashids\Middleware\DecodeHashidsMiddleware;
use Swindon\FilamentHashids\Support\HashidsManager;

class MiddlewareTest extends TestCase
{
    public function test_middleware_decodes_hashid()
    {
        $realId = 5;
        $hash = HashidsManager::encode($realId);

        // Create a request with a route parameter 'id' containing the hashed value.
        $request = Request::create("/test/{$hash}", 'GET');
        $route = (new Route(['GET'], '/test/{id}', []))->bind($request);
        $route->setParameter('id', $hash);
        $request->setRouteResolver(function () use ($route) {
            return $route;
        });

        $middleware = new DecodeHashidsMiddleware();

        $next = function ($req) {
            return $req;
        };

        $middleware->handle($request, $next);

        $this->assertEquals($realId, $route->parameter('id'));
    }
}
