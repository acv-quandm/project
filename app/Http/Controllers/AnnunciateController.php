<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnunciateController extends Controller
{
   public function index(){
       return view('annunciate.index');
   }
}
