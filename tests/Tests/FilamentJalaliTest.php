<?php

use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

it('formats state to jalali date', function () {
    Table::configureUsing(function (Table $table) {
        $table->defaultDateDisplayFormat('F d, Y');
    });

    $page = new ListRecords;
    $table = Table::make($page);

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر 15, 1368');
});

it('formats state based on default date display format', function () {
    Table::configureUsing(function (Table $table) {
        $table->defaultDateDisplayFormat('Y-m-d');
    });

    $page = new ListRecords;
    $table = Table::make($page);

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('1368-07-15');
});

it('uses farsi numbers if app locale is fa', function () {
    App::setLocale('fa');

    Table::configureUsing(function (Table $table) {
        $table->defaultDateDisplayFormat('F d, Y');
    });

    $page = new ListRecords;
    $table = Table::make($page);

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر ۱۵, ۱۳۶۸');
});

it('evaluates closures for format', function () {
    $oldRecord = ['__key' => 1, 'created_at' => Carbon::parse('1989-10-07')];
    $newRecord = ['__key' => 1, 'created_at' => Carbon::now()];

    $page = new ListRecords;
    $table = Table::make($page);

    $column = TextColumn::make('created_at')->table($table);

    expect($column)
        ->jalaliDateTime(fn (Carbon $state) => $state->isToday() ? 'H:i:s' : 'Y-m-d')
        ->record($oldRecord)
        ->formatState($oldRecord['created_at'])
        ->toBe('1368-07-15');

    $column = TextColumn::make('created_at')->table($table);

    expect($column)
        ->jalaliDateTime(fn (Carbon $state) => $state->isToday() ? 'H:i:s' : 'Y-m-d')
        ->record($newRecord)
        ->formatState($newRecord['created_at'])
        ->toBe($newRecord['created_at']->format('H:i:s'));
});
