<?php

namespace App\Model\HT10;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name', 'type', 'apartment_id', 'user_id', 'create_by','content','image','confirm','status','user_status'
    ];
    protected $table = "ht10-reviews";
}
