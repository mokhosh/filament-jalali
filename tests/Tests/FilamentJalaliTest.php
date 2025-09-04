<?php

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

it('formats state to jalali date', function () {
    $table = Mockery::mock(Table::class);
    $table->shouldReceive('getDefaultDateDisplayFormat')
        ->andReturn('F d, Y');

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر 15, 1368');
});

it('formats state based on default date display format', function () {
    $table = Mockery::mock(Table::class);
    $table->shouldReceive('getDefaultDateDisplayFormat')
        ->andReturn('Y-m-d');

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('1368-07-15');
});

it('uses farsi numbers if app locale is fa', function () {
    App::setLocale('fa');

    $table = Mockery::mock(Table::class);
    $table->shouldReceive('getDefaultDateDisplayFormat')
        ->andReturn('F d, Y');

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر ۱۵, ۱۳۶۸');
});

it('evaluates closures for format', function () {
    class User extends Model
    {
        protected $guarded = [];
    }

    $table = Mockery::mock(Table::class);
    $table->shouldReceive('getDefaultDateDisplayFormat')
        ->andReturn('Y-m-d');

    $livewireMock = Mockery::mock(HasTable::class);

    $livewireMock->shouldReceive('getTableRecordKey')
        ->andReturn('id');

    $table->shouldReceive('getLivewire')
        ->andReturn($livewireMock);

    $column = TextColumn::make('created_at');
    $column->table($table);

    expect($column)
        ->jalaliDateTime(fn($state) => now()->isSameDay($state) ? 'H:i:s' : 'Y-m-d')
        ->record(User::make(['created_at' => '1989-10-07']))
        ->formatState('1989-10-07')
        ->toBe('1368-07-15');

    $column = TextColumn::make('created_at');
    $column->table($table);
    expect($column)
        ->jalaliDateTime(fn($state) => now()->isSameDay($state) ? 'H:i:s' : 'Y-m-d')
        ->record(User::make(['created_at' => now()]))
        ->formatState(now())
        ->toBe(now()->format('H:i:s'));
});
