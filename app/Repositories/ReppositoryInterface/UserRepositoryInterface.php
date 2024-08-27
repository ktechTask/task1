<?php
namespace App\Repositories\ReppositoryInterface;


interface UserRepositoryInterface extends BaseRepositoryInterface{
    public function getUser();

    public function filter_date($start_day,$end_day);
}