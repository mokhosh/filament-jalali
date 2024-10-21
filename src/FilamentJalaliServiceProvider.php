<?php

namespace Mokhosh\FilamentJalali;

use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Components\Component;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentJalaliServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-jalali')
            ->hasViews('filament-jalali');
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            AlpineComponent::make('filament-jalali', __DIR__.'/../resources/js/dist/components/filament-jalali.js'),
        ], 'mokhosh/filament-jalali');

        TextColumn::macro('jalaliDate', function (?string $format = null, ?string $timezone = null) {
            $format ??= Table::$defaultDateDisplayFormat;

            $this->formatStateUsing(static function (Column $column, $state) use ($format, $timezone): ?string {
                if (blank($state)) {
                    return null;
                }

                return CalendarUtils::convertNumbers(
                    Jalalian::fromCarbon(
                        Carbon::parse($state)->setTimezone($timezone ?? $column->getTimezone())
                    )->format($format),
                    ! App::isLocale('fa')
                );
            });

            return $this;
        });

        TextColumn::macro('jalaliDateTime', function (?string $format = null, ?string $timezone = null) {
            $format ??= Table::$defaultDateTimeDisplayFormat;

            $this->jalaliDate($format, $timezone);

            return $this;
        });

        TextEntry::macro('jalaliDate', function (?string $format = null, ?string $timezone = null) {
            $format ??= Infolist::$defaultDateDisplayFormat;

            $this->formatStateUsing(static function (Component $component, $state) use ($format, $timezone): ?string {
                if (blank($state)) {
                    return null;
                }

                return CalendarUtils::convertNumbers(
                    Jalalian::fromCarbon(
                        Carbon::parse($state)->setTimezone($timezone ?? $component->getTimezone())
                    )->format($format),
                    ! App::isLocale('fa')
                );
            });

            return $this;
        });

        TextEntry::macro('jalaliDateTime', function (?string $format = null, ?string $timezone = null) {
            $format ??= Infolist::$defaultDateTimeDisplayFormat;

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
