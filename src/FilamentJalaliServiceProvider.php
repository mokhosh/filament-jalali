<?php

namespace Mokhosh\FilamentJalali;

use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentJalaliServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-jalali';

    public static string $viewNamespace = 'filament-jalali';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews(static::$viewNamespace);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'mokhosh/filament-jalali';
    }

    protected function getAssets(): array
    {
        return [
            AlpineComponent::make('jalali-date-time-picker', __DIR__.'/../resources/js/components/jalali-date-time-picker.js'),
        ];
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        TextColumn::macro('jalaliDate', function (string $format = null, string $timezone = null) {
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

        TextColumn::macro('jalaliDateTime', function (string $format = null, string $timezone = null) {
            $format ??= config('filament-jalali.datetime_format');

            $this->jalaliDate($format, $timezone);

            return $this;
        });

        TextEntry::macro('jalaliDate', function (string $format = null, string $timezone = null) {
            $format ??= config('filament-jalali.date_format');

            $this->formatStateUsing(static function ($state) use ($format, $timezone): ?string {
                if (blank($state)) {
                    return null;
                }

                return Jalalian::fromCarbon(Carbon::parse($state)
                    ->setTimezone($timezone))
                    ->format($format);
            });

            return $this;
        });

        TextEntry::macro('jalaliDateTime', function (string $format = null, string $timezone = null) {
            $format ??= config('filament-jalali.datetime_format');

            $this->jalaliDate($format, $timezone);

            return $this;
        });

        DateTimePicker::macro('jalali', function () {
            $this
                ->native(false)
                ->firstDayOfWeek(6)
                ->view('filament-jalali::jalali-date-time-picker');

            return $this;
        });
    }
}
