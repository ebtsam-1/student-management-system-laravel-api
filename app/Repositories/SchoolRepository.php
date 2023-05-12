<?php

namespace App\Repositories;

use App\Models\School;

class SchoolRepository extends BaseRepository
{
    public function __construct()
    {
        $searchColumn = 'name';
        Parent::__construct(new School, $searchColumn);
    }
}
