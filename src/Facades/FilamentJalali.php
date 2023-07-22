<?php

namespace Mokhosh\FilamentJalali\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mokhosh\FilamentJalali\FilamentJalali
 */
class FilamentJalali extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mokhosh\FilamentJalali\FilamentJalali::class;
    }
}
