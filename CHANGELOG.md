# Changelog

All notable changes to `filament-jalali` will be documented in this file.

## v5.0.0 - 2025-09-06

### What's Changed

* update to filament 4 by @amidesfahani in https://github.com/mokhosh/filament-jalali/pull/30

### New Contributors

* @amidesfahani made their first contribution in https://github.com/mokhosh/filament-jalali/pull/30

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.10.0...v5.0.0

## v4.10.0 - 2025-05-08

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.9.0...v4.10.0

## v4.9.0 - 2025-04-03

- short weekday by default
- update readme

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.8.0...v4.9.0

## v4.8.0 - 2025-04-02

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.7.2...v4.8.0

## v4.7.2 - 2025-03-29

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.7.1...v4.7.2

## v4.7.1 - 2025-03-29

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.7.0...v4.7.1

## v4.7.0 - 2025-03-29

### What's Changed

* Move to calidayjs to fix dated issues with alibaba's jalaliday
* Add Laravel 12 to test workflow by @MeghdadFadaee in https://github.com/mokhosh/filament-jalali/pull/23
* This PR fixing the GitHub Actions workflow for running tests. by @MeghdadFadaee in https://github.com/mokhosh/filament-jalali/pull/24

### New Contributors

* @MeghdadFadaee made their first contribution in https://github.com/mokhosh/filament-jalali/pull/23

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.6.0...v4.7.0

## v4.6.0 - 2025-03-07

### What's Changed

* Update composer.json for support laravel 12 by @Milad-Sarli in https://github.com/mokhosh/filament-jalali/pull/22

### New Contributors

* @Milad-Sarli made their first contribution in https://github.com/mokhosh/filament-jalali/pull/22

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.5.0...v4.6.0

## v4.5.0 - 2025-02-18

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.4.0...v4.5.0

## v4.4.0 - 2024-10-21

Add tests

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.3.0...v4.4.0

## v4.3.0 - 2024-09-29

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.2.0...v4.3.0

## v4.2.0 - 2024-09-22

Add farsi numbers

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.1.0...v4.2.0

## v4.1.0 - 2024-09-16

Removed config file

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v4.0.0...v4.1.0

## Remove ignore argument - 2024-09-08

People who need to ignore jalali conversion can rely on `when` and `unless` methods.

```php
TextColumn::make('created_at')
    ->when($condition, fn (TextColumn $column) => $column->jalaliDate()),
TextColumn::make('updated_at')
    ->unless($condition, fn (TextColumn $column) => $column->jalaliDateTime()),














```
## v3.5.0 - 2024-08-18

### What's Changed

* Allow multiple calendar systems by @mokhosh in https://github.com/mokhosh/filament-jalali/pull/11

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v3.4.1...v3.5.0

## v3.4.1 - 2024-08-16

- sync resources with filament original resources

## v3.4.0 - 2024-08-16

- add IDE helper for autocompletion

## v3.3.0 - 2024-07-02

This version adds the `ignore` attribute.

**Full Changelog**: https://github.com/mokhosh/filament-jalali/compare/v2.3.8...v3.3.0

## v3.2.6 - 2024-03-05

fix imports

## v3.2.5 - 2024-03-05

use ariaieboy's jalali to allow laravel 11

## v3.2.4 - 2024-03-05

Add Laravel 11 support

## Sync with Filament latest changes and fixes - 2023-08-23

Sync with Filament latest changes and fixes

## Sync with Filament v3 stable changes - 2023-08-03

This release syncs the view resource with how Filament changed "affixes" to "wrapper"

## Add jalali datetime picker - 2023-07-24

Adds a `jalali` method to `DatePicker` and `DateTimePicker` components.

## v1.2 - 2023-07-24

fix imports

## v1.1 - 2023-07-24

See if the jalali date time picker works as expected

## v1.0 - 2023-07-22

All seems good :)

## v0.1 - 2023-07-22

Checking if everything works as expected
