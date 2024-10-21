<?php

namespace Mokhosh\FilamentJalali\Tests;

use Mokhosh\FilamentJalali\FilamentJalaliServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FilamentJalaliServiceProvider::class,
        ];
    }
}
