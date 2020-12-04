<?php

namespace App\Models\HT10;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    protected $fillable = [
        'customer_code', 'attitude', 'knowledge', 'time', 'cost', 'diversity', 'quality', 'note'
    ];
    protected $table = "customer_feedback";
}
