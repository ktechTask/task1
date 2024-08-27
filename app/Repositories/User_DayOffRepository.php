<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\User_DayOff;
use App\Repositories\BaseRepository;
use App\Repositories\ReppositoryInterface\User_DayOffRepositoryInterface;
use App\Repositories\ReppositoryInterface\UserRepositoryInterface;

class User_DayOffRepository extends BaseRepository implements User_DayOffRepositoryInterface{
    public function getModel(){
        return User_DayOff::class;
    }
}

?>