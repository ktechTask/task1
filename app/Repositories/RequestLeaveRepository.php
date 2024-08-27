<?php
namespace App\Repositories;

use App\Models\request_leave;
use App\Repositories\BaseRepository;
use App\Repositories\ReppositoryInterface\RequestLeaveRepositoryInterface;


class RequestLeaveRepository extends BaseRepository implements RequestLeaveRepositoryInterface{
    public function getModel(){
        return request_leave::class;
    }
    public function search($request){
        $query = $this->model->join('dayoff_type', 'request_leave.type_dayoff_id', '=', 'dayoff_type.id')
        ->join('users', 'request_leave.user_id', '=', 'users.id')
        ->select('request_leave.*', 'dayoff_type.type_name', 'users.name');
    if (!empty($request->keywork)) {
        $query->where('users.name', $request->keywork);
    }
    if (isset($request->status) && $request->status != '') {
        $query->where('request_leave.status', $request->status);
    }
    return $query->get();
    }
    public function queryWhereUserId($user_id){
        return $query= $this->model->with('dayoff_type')->where('user_id',$user_id);
    }


}

?>