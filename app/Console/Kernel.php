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
        $schedule->command('db:backup')->weeklyOn(1, '8:00');
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
