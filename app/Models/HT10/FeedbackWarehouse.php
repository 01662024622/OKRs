<?php

namespace App\Models\HT10;

use Illuminate\Database\Eloquent\Model;

class FeedbackWarehouse extends Model
{
    protected $fillable = [
        'create_by','type', 'code_product', 'amount'
    ];
    protected $table = "feedback_warehouse";
}
