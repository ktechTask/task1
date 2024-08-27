<?php
namespace App\Repositories;

use App\Models\dayoff_type;
use App\Repositories\BaseRepository;
use App\Repositories\ReppositoryInterface\DayOffTypeRepositoryInterface;

class DayOffTypeRepository extends BaseRepository implements DayOffTypeRepositoryInterface{
    public function getModel(){
        return dayoff_type::class;
    }


}

?>