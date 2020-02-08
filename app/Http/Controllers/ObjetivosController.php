<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Objetivos;
use Auth;

class ObjetivosController extends Controller
{
    public function index(Request $request){
        $data = [];
        $data['objetivos'] = Objetivos::all();
        
        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('objetivos/index', compact($campos));
    }
    
    public function formObjetivos(){
        return view('objetivos/form');
    }
    
    public function sendObjetivos(Request $request){
        $objetivos = new Objetivos;
        
        $objetivos->descricao = $request->descricao;
        $objetivos->valor = $request->valor;
        $objetivos->prazo = $request->data;
        $objetivos->usuario_id = Auth::id();
        
        if($objetivos->save()){
            Toastr()->success('Objetivo adicionado com sucesso!');
            return redirect('/objetivos');
        }
    }
    
    public function delete($id){
        $objetivos = Objetivos::find($id);
        if($objetivos->delete()){
            Toastr()->error('Objetivo removido com sucesso!');
            return redirect('/objetivos');
        }
    }
    
    public function realizado($id){
        $objetivos = Objetivos::find($id);
        $objetivos->realizado = 1;
        if($objetivos->save()){
            Toastr()->success('Objetivo realizado com sucesso!');
            return redirect('/objetivos');
        }
    }
}
