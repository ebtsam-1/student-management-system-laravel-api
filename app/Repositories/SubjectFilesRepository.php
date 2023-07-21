<?php

namespace App\Repositories;

use App\Models\SubjectFiles;

class SubjectFilesRepositories extends BaseRepository
{
    public function __construct(protected SubjectFiles $subjectFiles, $searchColumns = [], $selects = [])
    {
        $searchColumns = ['path'];
        parent::__construct($subjectFiles, $searchColumns, $selects);
    }
}
