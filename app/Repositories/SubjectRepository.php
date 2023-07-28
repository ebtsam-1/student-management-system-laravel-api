<?php

namespace App\Repositories;

use App\Models\School;
use App\Models\Subject;

class SubjectRepository extends BaseRepository
{
    public function __construct(protected Subject $subject, $searchColumns = [], $selects = [])
    {
        $searchColumns = ['name'];
        Parent::__construct($subject, $searchColumns);
    }
}
