<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Swindon\FilamentHashids\Support\HashidsManager;

class HashidsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Create a test route that uses the decode-hashids middleware.
        Route::middleware('decode-hashids')->group(function () {
            Route::get('/test/{id}', function ($id) {
                return response()->json(['id' => $id]);
            });
        });
    }

    public function test_hashid_is_decoded_in_route()
    {
        $realId = 1;
        $hash = HashidsManager::encode($realId);

        $response = $this->get("/test/{$hash}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $realId]);
    }
}
