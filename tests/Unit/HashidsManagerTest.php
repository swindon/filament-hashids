<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Swindon\FilamentHashids\Support\HashidsManager;

class HashidsManagerTest extends TestCase
{
    public function test_encode_and_decode()
    {
        $id = 123;
        $hash = HashidsManager::encode($id);
        $decoded = HashidsManager::decode($hash);

        $this->assertIsArray($decoded);
        $this->assertEquals([$id], $decoded);
    }
}
