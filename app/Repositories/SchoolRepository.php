<?php

namespace App\Repositories;

use App\Models\School;

class SchoolRepository extends BaseRepository
{
    public function __construct(protected School $school, $searchColumns = [], $selects = [] )
    {
        $searchColumn = 'name';
        Parent::__construct($school, $searchColumn);
    }
}
