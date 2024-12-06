<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\DbDumper\Databases\MySql;

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

        $fileName = storage_path('/app/backup/' . date('Y-m-d_H-i-s') . '_backup.sql');

        // Ensure the backups directory exists
        if (!file_exists(storage_path('/app/backup/'))) {
            mkdir(storage_path('/app/backup/'), 0755, true);
        }

        try {
            MySql::create()
                ->setDbName(env('DB_DATABASE'))
                ->setUserName(env('DB_USERNAME'))
                ->setPassword(env('DB_PASSWORD'))
                ->setHost(env('DB_HOST'))
                ->dumpToFile($fileName);

            $this->info("Backup successful! Saved to: $fileName");
        } catch (\Exception $e) {
            $this->error("Backup failed: " . $e->getMessage());
        }

        return 0;


        // \Log::info("Cake Cron execution!");
        // $this->info('db:backup Command is working fine!');
    }
}
