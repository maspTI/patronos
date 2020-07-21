<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GoogleDriveUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileName;
    protected $directory = 'logos';
    public $tries = 3;
    public $timeout = 600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $fileName, string $directory = '')
    {
        $this->fileName = $fileName;
        $this->directory = $directory == '' ? 'logos' : $directory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = public_path("{$this->directory}/") . $this->fileName;
        if (Storage::disk('google')->put($this->fileName, fopen($file, 'r+'))) {
            File::delete($file);
        }
    }
}
