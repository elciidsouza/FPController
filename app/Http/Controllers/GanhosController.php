<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ganhos;
use Auth;

class GanhosController extends Controller
{
    public function index(Request $request){
        $ganhos = Ganhos::where(function($q) use ($request) {
            if (isset($request['descricao']) && $request['descricao']) {
                $q->where('descricao', 'like', '%' . $request->descricao . '%');
            }
            if (isset($request['mes']) && $request['mes']) {
                $q->where('data', 'like', '%-' . $request->mes . '-%');
            }
            if (isset($request['ano']) && $request['ano']) {
                $q->where('data', 'like', '%' . $request->ano . '-%');
            }
            if(!isset($request['descricao']) && !isset($request['mes'])){
                $q->where('data', 'like', date('Y-m') . '-%')->orWhere('fixo', '=', 1);
            }
        }
        )->where('usuario_id', '=', Auth::id());
        $data['ganhos'] = $ganhos->get();
        //$data['ganhos'] = Ganhos::where('usuario_id', '=', Auth::id())->get();
        $data['ganhosTotal'] = $ganhos->sum('valor');
        
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
            Toastr()->success('Ganho adicionado com sucesso!');
            return redirect('/ganhos');
        }
        
    }
    
    public function delete($id){
        $ganhos = Ganhos::find($id);
        if($ganhos->delete()){
            Toastr()->error('Registro excluido com sucesso!');
            return redirect('/ganhos');
        }
    }
}
