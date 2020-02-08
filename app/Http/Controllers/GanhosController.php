<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ganhos;
use Auth;

class GanhosController extends Controller
{
    public function index(){
        $data['ganhos'] = Ganhos::where('usuario_id', '=', Auth::id())->get();
        $data['ganhosTotal'] = Ganhos::where('usuario_id', '=', Auth::id())->sum('valor');
        
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('ganhos/index', compact($campos));
    }
    
    public function formGanhos($id = 0){
        $data = [];
        if($id != 0){
            $data['ganhos'] = Ganhos::find($id);
        }
        
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('ganhos/form', compact($campos));
    }
    
    public function sendGanhos(Request $request){
        if(isset($request->id)){
            $ganhos = Ganhos::find($request->id);
        } else {
            $ganhos = new Ganhos;
        }
        
        $ganhos->descricao = $request->descricao;
        $ganhos->valor = $request->valor;
        $ganhos->usuario_id = Auth::id();
        if($request->fixo == 'on'){
            $ganhos->fixo = 1;
        } else {
            $ganhos->data = $request->data;
        }
        
        if($ganhos->save()){
            return redirect('ganhos');
        }
        
    }
}
