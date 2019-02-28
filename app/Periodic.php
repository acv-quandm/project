<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodic extends Model
{
    public function healths(){
        return $this->hasMany(Health::class);
    }
    public function user(){

    }
}
