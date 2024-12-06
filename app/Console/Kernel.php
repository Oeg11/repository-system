<?php

namespace App\Console;

use App\Console\Commands\DbBackup;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [

        DbBackup::class,

    ];

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('db:backup')->everyMinute();
        // $schedule->command('db:backup')->hourly();
        $schedule->command('db:backup')->daily();
        // $schedule->command('db:backup')->weekly();
        // $schedule->command('db:backup')->monthly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
