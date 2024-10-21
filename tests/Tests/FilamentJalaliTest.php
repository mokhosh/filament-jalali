<?php

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

it('formats state to jalali date', function () {
    expect(TextColumn::make(''))
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر 15, 1368');
});

it('formats state based on default date display format', function () {
    $reset = Table::$defaultDateDisplayFormat;
    Table::$defaultDateDisplayFormat = 'Y-m-d';

    expect(TextColumn::make(''))
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('1368-07-15');

    Table::$defaultDateDisplayFormat = $reset;
});

it('uses farsi numbers if app locale is fa', function () {
    App::setLocale('fa');

    expect(TextColumn::make(''))
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر ۱۵, ۱۳۶۸');
});
