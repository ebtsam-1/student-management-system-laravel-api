<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\SubjectFilesRepository;
use Carbon\Carbon;

class SaveFilesService
{
    public function __construct(private SubjectFilesRepository $subjectFilesRepository)
    {

    }

    public function handle($subject, $filesData)
    {
        $allowedSize = Setting::first();

        $files = [];
        $filesSize = 0;
        $fileSizeReached = $allowedSize->max_file_size;
        $flag2 = true;
        $flag = false;
        foreach($filesData as $file){
            $fileDetails = [];
            $filePath = date('y/m/d') . '/' . rand(1111,9999) . '.' .$file->getClientOriginalExtension();
            $fileDetails['type'] = explode('/',$file->getMimeType())[0];
            $fileDetails['size'] = $file->getSize() / 1000;
            $fileDetails['path'] = $filePath;
            $fileDetails['subject_id'] = $subject->id;
            $fileDetails['created_at'] = Carbon::now();
            $fileDetails['updated_at'] = Carbon::now();
            $files[] = $fileDetails;

            $filesSize += $fileDetails['size'];

            $fileSizeReached -= $fileDetails['size'];

            if($fileSizeReached <= 0){
                $flag2 = false;
                break;
            }
            $file->storeAs('public/' . $filePath);
        }
        $this->subjectFilesRepository->massInsert($files);

        if($flag2){
            $allowedSize->update(['max_file_size' => $allowedSize->max_file_size - $filesSize]);
            $flag = true;
        }
        return $flag;

    }
}
