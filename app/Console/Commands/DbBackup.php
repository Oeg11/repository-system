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

        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $backupPath = storage_path('backups/' . date('Y-m-d_H-i-s') . '_backup.sql');

        // Ensure the backups directory exists
        if (!file_exists(storage_path('backups'))) {
            mkdir(storage_path('backups'), 0755, true);
        }

        $command = "mysqldump -h $dbHost -u $dbUser -p$dbPass $dbName > $backupPath";

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Backup successful! Saved to: $backupPath");
        } else {
            $this->error("Backup failed. Check your configuration or permissions.");
        }

        return $returnVar;

        // \Log::info("Cake Cron execution!");
        // $this->info('db:backup Command is working fine!');
    }
}
