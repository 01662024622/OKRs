<?php

namespace App\Models\HT00;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'parent_id', 'status', 'slug', 'type', 'url', 'create_by', 'modify_by','sort'
    ];
    public $fillable_store = [
        'title', 'parent_id', 'type', 'url','role'
    ];
    public $fillable_update = [
        'title', 'parent_id', 'type', 'url','role'
    ];
    protected $table = "ht00_categories";
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('sort');
    }
}
