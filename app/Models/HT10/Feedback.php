<?php

namespace App\Models\HT10;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'content','order', 'note','user_id'
    ];
    protected $fillable_store = [
        'content','order', 'note','user_id'
    ];
    protected $fillable_update = [];
    protected $table = "feedbacks";
}
