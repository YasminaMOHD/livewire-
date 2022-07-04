<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // public function basicTest()
    // {
    //     $responce = $this->get('/login');
    //     $responce->assertStatus(200);
    // }

}
