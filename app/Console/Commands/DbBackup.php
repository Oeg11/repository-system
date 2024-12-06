<?php

namespace App\Console\Commands;

use Log;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a backup Database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $output = "junil toledo";

            Log::error("Database backup failed: ", $output);

    }
}
