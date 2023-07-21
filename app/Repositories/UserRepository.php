<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(protected User $user, $searchColumn = [], $selects = [])
    {
        $searchColumn = ['name'];
        Parent::__construct($user, $searchColumn);
    }
}
