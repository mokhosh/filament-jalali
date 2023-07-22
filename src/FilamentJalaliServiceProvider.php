<?php

namespace Mokhosh\FilamentJalali;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Mokhosh\FilamentJalali\Commands\FilamentJalaliCommand;

class FilamentJalaliServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-jalali')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-jalali_table')
            ->hasCommand(FilamentJalaliCommand::class);
    }
}
