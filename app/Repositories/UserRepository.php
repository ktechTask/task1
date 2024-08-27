<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\ReppositoryInterface\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    public function getModel(){
        return User::class;
    }

    public function getUser(){
        return $this->model->withCount('userDayOff')->get();
    }

    public function filter_date($start_day,$end_day){
        return $this->model->withCount(['userDayOff' => function ($query) use ($start_day, $end_day) {
            $query->where('day_off', '>', $start_day)
                  ->where('day_off', '<', $end_day);
        }])->get();
    }

}

?>