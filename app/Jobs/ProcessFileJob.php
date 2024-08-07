<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProcessFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    /**
     * Create a new job instance.
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filePath = $this->file->getPathname();
        $fileName = $this->file->getFilename();

        $content = file_get_contents($filePath);
        DB::table('uploads')->insert([
            'file_name' => $fileName,
            'content' => $content,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Storage::delete($filePath);
    }
}
