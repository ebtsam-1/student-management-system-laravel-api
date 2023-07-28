<?php

namespace App\Repositories;

use App\Models\School;
use App\Models\Student;

class StudentRepository extends BaseRepository
{
    public function __construct(protected Student $student, $searchColumns = [], $selects = [])
    {
        $searchColumns = ['name'];
        Parent::__construct(new School, $searchColumns, $selects);
    }
}
