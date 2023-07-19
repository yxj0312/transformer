<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     // 绑定 UserRepositoryInterface 到 UserRepository
    //     $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    // }
}
