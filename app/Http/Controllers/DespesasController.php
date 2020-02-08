<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Despesas;
use Auth;

class DespesasController extends Controller
{
    public function index(Request $request){
        $ganhos = Despesas::where(function($q) use ($request) {
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

        return view('despesas/index', compact($campos));
    }
}
