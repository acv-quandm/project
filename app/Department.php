<?php

namespace App;


class Department extends BaseModel
{
    public function lecturers(){
        return $this->hasMany(Lecturer::class);
    }
}
