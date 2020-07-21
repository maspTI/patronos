<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Jobs\GoogleDriveUpload;

trait UploadFileToDrive
{
    /**
     *
     */
    protected function uploadFile(Request $request)
    {
        $fileName = time() . '.' . request()->file('recipt')->getClientOriginalExtension();

        request()->file('recipt')->move(public_path($this->directory), $fileName);
        GoogleDriveUpload::dispatch($fileName, $this->directory);

        return $fileName;
    }
}
