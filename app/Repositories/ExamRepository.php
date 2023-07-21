<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRespository extends BaseRepository
{
    public function __construct(protected Exam $exam, $searchColumns = [] , $selects = [])
    {
        $searchColumns = [];
        parent::__construct($exam, $searchColumns, $selects);
    }
}
