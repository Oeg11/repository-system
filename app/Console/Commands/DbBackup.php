<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

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

        try {
            $backupJob = BackupJobFactory::createFromArray(config('backup'));
            $backupJob->run();
            $this->info('Backup completed successfully!');
        } catch (\Exception $e) {
            $this->error('Backup failed: ' . $e->getMessage());
        }

        return 0;

        // $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";

  

        // $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/storage/uploads/" . $filename;

        // $returnVar = NULL;

        // $output  = NULL;

  

        // exec($command, $output, $returnVar);
    }
}
