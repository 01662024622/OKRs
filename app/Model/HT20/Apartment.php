<?php

namespace App\Model\HT20;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
	protected $fillable = [
        'name', 'code', 'description','status','user_id'
    ];
    protected $table = "apartments";

    public function users()
    {
        return $this->hasMany('App\Model\HT20\User');
    }
}
