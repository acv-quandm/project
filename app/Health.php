<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    public function lecturer(){
        return $this->belongsTo(Health::class);
    }
    public function drugs(){
        return $this->belongsToMany(Drug::class);
    }
}
