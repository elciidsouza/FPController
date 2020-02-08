<?php

namespace App\Http\Controllers;

use App\Cartao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartaoController extends Controller
{

    public function index(Request $request)
    {
        $cartao = Cartao::where(function($q) use ($request) {
            if (isset($request['nome']) && $request['nome']) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            }
        })->where('cartao.usuario_id', '=', Auth::id());


        $data['cartoes'] = $cartao->get();
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('cartoes.index', compact($campos));
    }

    public function formCartoes(){
        return view('cartoes.form');
    }


    public function sendCartoes(Request $request)
    {
        $cartao = new Cartao;
        $cartao->nome = $request->nome;
        $cartao->dia_vencimento = $request->dia_vencimento;
        $cartao->limite = $request->limite;
        $cartao->usuario_id = Auth::id();

        if($cartao->save()){
            Toastr()->success('Cartão adicionada com sucesso!');
            return redirect('/cartoes');
        }
    }

    public function delete($id)
    {
        $cartao = Cartao::find($id);
        if($cartao->delete()){
            Toastr()->error('Cartão removida com sucesso!');
            return redirect('/cartoes');
        }
    }
}
