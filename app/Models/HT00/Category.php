<?php

namespace App\Models\HT00;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'status', 'slug',
    ];
    public $fillable_store = [
        'name', 'parent_id'
    ];
    public $fillable_update = [
        'name', 'parent_id'
    ];
    protected $table = "categories";
}
