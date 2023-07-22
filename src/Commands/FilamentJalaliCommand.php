<?php

namespace Mokhosh\FilamentJalali\Commands;

use Illuminate\Console\Command;

class FilamentJalaliCommand extends Command
{
    public $signature = 'filament-jalali';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
