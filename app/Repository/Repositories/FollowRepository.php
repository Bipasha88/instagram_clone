<?php

namespace App\Repository\Repositories;

use App\Models\Follow;
use App\Models\User;
use App\Repository\Interfaces\EloquentRepositoryInterface;
use App\Repository\Interfaces\FollowRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FollowRepository extends BaseRepository implements FollowRepositoryInterface{

    protected $model;

    public function __construct(Follow $model){
        $this->model=$model;

    }


}
