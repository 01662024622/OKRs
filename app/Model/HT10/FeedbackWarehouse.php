<?php

namespace App\Model\HT10;

use Illuminate\Database\Eloquent\Model;

class FeedbackWarehouse extends Model
{
    protected $fillable = [
        'user_id','type', 'code_product', 'amount'
    ];
    protected $table = "feedback_warehouse";
}
