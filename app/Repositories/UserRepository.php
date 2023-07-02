<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $user, $searchColumn = [])
    {
        $searchColumn = ['name'];
        Parent::__construct(new User, $searchColumn);
    }
}
