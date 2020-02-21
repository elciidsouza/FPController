<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{

    public function index(Request $request)
    {
        $cartao = Categoria::where(function($q) use ($request) {
            if (isset($request['nome']) && $request['nome']) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            }
        })->where('categoria.usuario_id', '=', Auth::id());


        $data['categoria'] = $cartao->get();
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('categorias.index', compact($campos));
    }


    public function formCategorias()
    {
        return view('categorias.form');
    }


    public function sendCategorias(Request $request)
    {
        $categoria = new Categoria;
        $categoria->nome = $request->nome;
        if($request->contabiliza == 'on'){
            $categoria->contabiliza = 1;
        }
        $categoria->usuario_id = Auth::id();

        if($categoria->save()){
            Toastr()->success('Categoria adicionada com sucesso!');
            return redirect('/categorias');
        }
    }

    public function deleteCategorias($id)
    {
        $categoria = Categoria::find($id);
        if($categoria->delete()){
            Toastr()->error('Categoria removida com sucesso!');
            return redirect('/categorias');
        }
    }
}
