<?php

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Carbon;

it('formats state to jalali date', function () {
    expect(TextColumn::make(''))
        ->jalaliDate()
        ->formatState(Carbon::parse('1989-10-07'))
        ->toBe('مهر 15, 1368');
});

