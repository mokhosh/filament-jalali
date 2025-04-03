# Add "Jalali calendar" columns and pickers to Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mokhosh/filament-jalali.svg?style=flat-square)](https://packagist.org/packages/mokhosh/filament-jalali)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mokhosh/filament-jalali/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mokhosh/filament-jalali/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mokhosh/filament-jalali.svg?style=flat-square)](https://packagist.org/packages/mokhosh/filament-jalali)

![Jalali datetime picker form component and table text column](https://raw.githubusercontent.com/mokhosh/filament-jalali/main/art/readme.jpg)

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
If you want to ignore jalali conversion you can use the `when` and `unless` methods:

```php
use Filament\Tables;
use Filament\Infolists\Components;
use Filament\Forms;
use Illuminate\Support\Facades\App;

Tables\Columns\TextColumn::make('created_at')
    ->date()
    ->when(App::isLocale('fa'), fn (TextColumn $column) => $column->jalaliDate()),

Components\TextEntry::make('updated_at')
    ->dateTime()
    ->unless(App::isLocale('en'), fn (TextColumn $column) => $column->jalaliDateTime()),

Forms\Components\DatePicker::make('birthday')
    ->when(App::isLocale('fa'), fn (TextColumn $column) => $column->jalali()),
```

## Configuring the Format Globally
You can set the default date formats for tables, infolists and date/time pickers anywhere you want, likely in a service provider:

```php
public function boot(): void
{
    Table::$defaultDateDisplayFormat = 'Y/m/d';
    Table::$defaultDateTimeDisplayFormat = 'Y/m/d H:i:s';

    Infolist::$defaultDateDisplayFormat = 'Y/m/d';
    Infolist::$defaultDateTimeDisplayFormat = 'Y/m/d H:i:s';

    DateTimePicker::$defaultDateDisplayFormat = 'Y/m/d';
    DateTimePicker::$defaultDateTimeDisplayFormat = 'Y/m/d H:i';
    DateTimePicker::$defaultDateTimeWithSecondsDisplayFormat = 'Y/m/d H:i:s';
}
```

Some common formats you might want to use:

`j F Y` <span dir="rtl">۱۵ مهر ۱۳۶۸</span>

`Y/m/d` <span dir="rtl">۱۳۶۸/۰۷/۱۵</span>

`l j F` <span dir="rtl">شنبه ۱۵ مهر</span>

## Credits

- [Mo Khosh](https://github.com/mokhosh)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
