<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function healths(){
        return $this->hasMany(Health::class);
    }
}
