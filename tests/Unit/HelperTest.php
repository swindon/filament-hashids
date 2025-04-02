<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Swindon\FilamentHashids\Traits\HasHashid;
use Swindon\FilamentHashids\Support\HashidsManager;

class DummyModel {
    use HasHashid;

    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getKey()
    {
        return $this->id;
    }
}

class HelperTest extends TestCase
{
    public function test_hashid_directive_helper()
    {
        $model = new DummyModel(42);
        $expected = HashidsManager::encode(42);
        $this->assertEquals($expected, $model->getHashid());
    }
}
