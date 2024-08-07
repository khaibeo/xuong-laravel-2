<?php

namespace App\Console\Commands;

use App\Jobs\ProcessFileJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ProcessFileUploads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-file-uploads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dir = storage_path('app/uploads');

        $files = File::files($dir);

        foreach ($files as $file) {
            ProcessFileJob::dispatch($file);
        }

        return 0;
    }
}
