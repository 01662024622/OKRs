<?php

namespace App\Model\HT10;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'content','order', 'note','user_id'
    ];
    protected $table = "feedbacks";
}
