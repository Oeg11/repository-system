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
        $backupPath = public_path('storage/backup/' . date('Y-m-d_H-i-s') . '_backup.sql');

        $command = "mysqldump -h $dbHost -u $dbUser -p$dbPass $dbName > $backupPath";

        $process = shell_exec($command);

        if ($process === null) {
            $this->info("Backup saved to: $backupPath");
        } else {
            $this->error("Backup failed!");
        }


        // if (! Storage::exists('backup')) {
        //     Storage::makeDirectory('backup');
        // }

        // $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";

        // $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD')
        //         . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE')
        //         . "  | gzip > " . public_path('/storage/backup/') . $filename;

  
    }
}
