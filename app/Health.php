<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
    public function drugs(){
        return $this->belongsToMany(Drug::class);
    }
    public function drugs_health(){
        return $this->hasMany(DrugHealth::class);
    }
}
