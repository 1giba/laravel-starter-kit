<?php

namespace App\Repositories;

use OneGiba\DataLayer\Traits\Resfulable;
use App\Models\User;

class UserRepository extends BaseRepository
{
    use Restfulable;

    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @var array
     */
    protected $tag = ['user'];
}