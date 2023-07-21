<?php

namespace App\Repositories;

use App\Models\School;
use App\Models\SchoolClass;

class SchoolClassRepository extends BaseRepository
{
    public function __construct(protected SchoolClass $schoolClass, $searchColumns = [], $selects = [] )
    {
        $searchColumn = 'name';
        Parent::__construct($schoolClass, $searchColumn);
    }
}
