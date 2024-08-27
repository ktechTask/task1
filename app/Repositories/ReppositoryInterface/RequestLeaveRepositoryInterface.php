<?php
namespace App\Repositories\ReppositoryInterface;


interface RequestLeaveRepositoryInterface extends BaseRepositoryInterface{
    public function search($request);
    public function queryWhereUserId($user_id);
}