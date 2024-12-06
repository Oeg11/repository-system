<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Carbon\Carbon;
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

            $fileName = "backup-".Carbon::now()->format('Y-m-d_H-i-s').".gz";
            $command = "mysqldump --user=". env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" .  env('DB_HOST') . " ". env('DB_DATABASE') . " gzip > " . storage_path() . "/app/backup/". $fileName;
            $output = NULL;
            $returnVar = NULL;

            exec($command, $output, $returnVar);

            if ($returnVar === 0) {
                $this->info("Backup successful! Saved to: $fileName");
            } else {
                $this->error("Backup failed. Check your configuration or permissions.");
            }

            return $returnVar;


        // \Log::info("Cake Cron execution!");
        // $this->info('db:backup Command is working fine!');
    }
}
