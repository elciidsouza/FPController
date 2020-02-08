<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GanhosController extends Controller
{
    public function index(){
        return view('ganhos/index');
    }
}
