# Add "Jalali calendar" columns and pickers to Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mokhosh/filament-jalali.svg?style=flat-square)](https://packagist.org/packages/mokhosh/filament-jalali)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mokhosh/filament-jalali/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mokhosh/filament-jalali/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mokhosh/filament-jalali.svg?style=flat-square)](https://packagist.org/packages/mokhosh/filament-jalali)

No fuss package to add Jalali Date and DateTime columns to your table, and a beautiful Jalali Date and DateTime picker to your forms.
No new column type, just keep using your good old `TextColumn`s!
No new form components, just keep using your beautiful `DatePicker`s and `DateTimePicker`s!

## Installation

You can install the package via composer:

```bash
composer require mokhosh/filament-jalali
```

## Usage

To add Jalali date and date-time columns to your tables, just add `jalaliDate` and `jalaliDateTime` to the filament `TextColumn`s instead of `date` or `dateTime`.

```php
// Yes! Just use Filament's original TextColumns!
use Filament\Tables;

Tables\Columns\TextColumn::make('created_at')
    ->jalaliDate(),
Tables\Columns\TextColumn::make('updated_at')
    ->jalaliDateTime(),
```

To add Jalali date and date-time columns to your infolists, just add `jalaliDate` and `jalaliDateTime` to the filament `TextEntry`s instead of `date` or `dateTime`.

```php
use Filament\Infolists\Components;

Components\TextEntry::make('created_at')
    ->jalaliDate(),
Components\TextEntry::make('updated_at')
    ->jalaliDateTime(),
```

To add Jalali date and date-time pickers to your forms, just add `jalali`to your `DatePicker` and `DateTimePicker`.

```php
// Yes! Just use Filament's original DatePickers and DateTimePickers!
use Filament\Forms;

Forms\Components\DatePicker::make('moderated_at')
    ->jalali(),
Forms\Components\DateTimePicker::make('published_at')
    ->jalali(),
```

## Ignoring Jalali Conversion
If you want to ignore jalali conversion you can use the `ignore` parameter:

```php
use Filament\Tables;
use Filament\Infolists\Components;
use Filament\Forms;
use Illuminate\Support\Facades\App;

Tables\Columns\TextColumn::make('created_at')
    ->jalaliDate(ignore: App::isLocale('en')),

Components\TextEntry::make('updated_at')
    ->jalaliDateTime(ignore: App::isLocale('fr')),

Forms\Components\DatePicker::make('moderated_at')
    ->jalali(ignore: App::isLocale('es')),
```

## Config
You can optionally publish the config file with:

```bash
php artisan vendor:publish --tag="filament-jalali-config"
```

This is the contents of the published config file:

```php
return [
    'date_format'=>'Y/m/d',
    'datetime_format'=>'Y/m/d H:i:s',
];
```

## Credits

- [Mo Khosh](https://github.com/mokhosh)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
