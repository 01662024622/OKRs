<?php

namespace App\Model\HT10;

use Illuminate\Database\Eloquent\Model;

class FeedbackWarehouseImprove extends Model
{
    protected $fillable = [
        'improve_360_id', 'feedback_warehouse_id'
    ];
    protected $table = "feedback_warehouse_improve";
}
