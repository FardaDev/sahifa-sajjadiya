<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Backup Schedule
|--------------------------------------------------------------------------
|
| Schedule automated backups using Spatie Laravel Backup.
| - 01:00 UTC: Clean old backups
| - 02:00 UTC: Run backup
| - 03:00 UTC: Monitor backup health
|
*/

Schedule::command('backup:clean')->daily()->at('01:00');
Schedule::command('backup:run')->daily()->at('02:00');
Schedule::command('backup:monitor')->daily()->at('03:00');
