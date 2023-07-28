<?php


namespace App\Services;

use Illuminate\Support\Facades\Storage;

class HandleFileSizeService
{
    public function __construct(private SaveFilesService $saveFilesService)
    {

    }

    public function handle($subject, $filesDetails)
    {
        if(! $this->saveFilesService->handle($subject, $filesDetails)){
            foreach($subject->files as $file){
                Storage::disk('public')->delete($file->path);
            }
            $subject->files()->delete();
            $subject->delete();
            return response()->json(['message' => 'file uploading has reached the maximum'], 400);
        }
        return response()->json(['message' => 'creating process in progress']);
    }
}
