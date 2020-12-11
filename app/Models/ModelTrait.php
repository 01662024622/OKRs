<?php


namespace App\Models;


trait ModelTrait
{

    protected $fillable_store=[];
    protected $fillable_update=[];
    public function getStore() :array
    {
        return $this->fillable_store;
    }
    public function getUpdate() :array
    {
        return $this->fillable_update;
    }
}
