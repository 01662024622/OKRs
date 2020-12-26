<?php

namespace App\Models\HT00;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'status', 'slug', 'type', 'url', 'create_by', 'modify_by'
    ];
    public $fillable_store = [
        'name', 'parent_id', 'status', 'type', 'url'
    ];
    public $fillable_update = [
        'name', 'parent_id', 'status', 'type', 'url'
    ];
    protected $table = "ht00_categories";
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('sort');
    }
}
