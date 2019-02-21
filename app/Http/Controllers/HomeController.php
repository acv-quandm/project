<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        return view('home.index');
    }
    public function replacePassword(Request $request){
        $user = Auth::user();
        if(Hash::check($request->old_password,$user->password))
        {
            $user->password = $request->new_password;
            $user->save();
            return back();
        }
        else{
            return back()->withErrors([
                'error' => 1
            ]);
        }
    }
}
