<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GanhosController extends Controller
{
    public function index(){
        return view('ganhos/index');
    }
    
    public function formGanhos($id = 0){
        if($id != 0){
            
        }
    }
}
