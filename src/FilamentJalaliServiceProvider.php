<?php

namespace Mokhosh\FilamentJalali;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentJalaliServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-jalali')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        TextColumn::macro('jalaliDate', function(?string $format = null, ?string $timezone = null) {
            $format ??= config('filament-jalali.date_format');

            $this->formatStateUsing(static function (Column $column, $state) use ($format, $timezone): ?string {
                if (blank($state)) {
                    return null;
                }

                return Jalalian::fromCarbon(Carbon::parse($state)
                    ->setTimezone($timezone ?? $column->getTimezone()))
                    ->format($format);
            });

            return $this;
        });

        TextColumn::macro('jalaliDateTime', function(?string $format = null, ?string $timezone = null) {
            $format ??= config('filament-jalali.datetime_format');

            $this->date($format, $timezone);

            return $this;
        });
    }
}
