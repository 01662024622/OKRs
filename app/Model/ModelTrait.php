<?php


namespace App\Model;


trait ModelTrait
{

    public function getStore(){
        return $this->fillable_store;
    }
    public function getUpdate(){
        return $this->fillable_update;
    }
}
