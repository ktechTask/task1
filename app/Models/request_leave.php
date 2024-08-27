<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_leave extends Model
{
    use HasFactory;
    protected $table = 'request_leave';
    protected $guarded = [];
}
