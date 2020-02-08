<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Despesas;
use App\Cartao;
use App\Categoria;
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
        )->leftJoin('cartao', 'cartao_id', '=', 'cartao.id')->leftJoin('categoria', 'categoria_id', '=', 'categoria.id')->where('despesas.usuario_id', '=', Auth::id())->select('despesas.id', 'despesas.descricao', 'despesas.valor', 'despesas.tipo_despesa', 'despesas.fixo', 'despesas.data', 'cartao.nome AS nome_cartao', 'categoria.nome AS nome_categoria');
        $data['despesas'] = $ganhos->get();
        //$data['ganhos'] = Ganhos::where('usuario_id', '=', Auth::id())->get();
        $data['despesasTotal'] = $ganhos->sum('valor');
        
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('despesas/index', compact($campos));
    }
    
    public function formDespesas(){
        $data = [];
        
        $data['cartoes'] = Cartao::where('usuario_id', '=', Auth::id())->get();
        $data['categorias'] = Categoria::where('usuario_id', '=', Auth::id())->get();
        
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('despesas/form', compact($campos));
    }
    
    public function sendDespesas(Request $request){
        if(isset($request->parcelas)){
            $parcelas = $request->parcelas;
        } else {
            $parcelas = 1;
        }
        for($i = 0; $i < $parcelas; $i++){
            $despesa = new Despesas;
            
            $valorDescricao = $i + 1;
            
            $despesa->descricao = $request->descricao . ' ' . $valorDescricao . '/' . $parcelas;
                $despesa->valor = $request->valor / $parcelas;

            if($request->fixo == 'on'){
                $despesa->fixo = 1;
            } else {
                $despesa->data = date("Y-m-d", strtotime("+" . $i . "month", strtotime($request->data)));
            }

            $despesa->tipo_despesa = $request->tipo_despesa;
            $despesa->cartao_id = $request->cartao_id;
            $despesa->categoria_id = $request->categoria_id;
            $despesa->usuario_id = Auth::id();

            $despesa->save();
        }
        
        Toastr()->success('Despesa adicionada com sucesso!');
        return redirect('/despesas');
        
    }
    
    public function delete($id){
        $despesa = Despesas::find($id);
        if($despesa->delete()){
            Toastr()->error('Despesa removida com sucesso!');
            return redirect('/despesas');
        }            
    }
}
