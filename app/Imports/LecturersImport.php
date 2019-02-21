<?php

namespace App\Imports;

use App\Lecturer;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class LecturersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row[5]))
        {
            if(User::where('email',$row[5])->first() == null){
                $user = new User();
                $user->email = $row[5];
                $user->name = $row[0];
                $user->password = Hash::make($row[5]);
                $user->save();
                $lecturer = new Lecturer();
                $lecturer->name = $row[0];
                $lecturer->address = $row[1];
                $lecturer->phone_number = $row[2];
                $lecturer->department_id = $row[3];
                $lecturer->birthday = $row[4];
                $lecturer->email = $row[5];
                $lecturer->user_id = $user->id;
                $lecturer->save();
            }
        }

        return [

        ];
    }
}
