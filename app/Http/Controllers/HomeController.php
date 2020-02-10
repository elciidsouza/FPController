<?php

namespace App\Http\Controllers;

use App\Despesas;
use App\Ganhos;
use App\Objetivos;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::id();

        $ganhos = Ganhos::where('data', 'like', date('Y-m') . '-%')
        ->orWhere('fixo', '=', 1)
        ->where('ganhos.usuario_id', '=', $user);

        $data['valorT'] = $ganhos->sum('valor');

        $despesas = Despesas::where('data', 'like', date('Y-m') . '-%')
        ->leftJoin('cartao', 'cartao_id', '=', 'cartao.id')
        ->leftJoin('categoria', 'categoria_id', '=', 'categoria.id')
        ->where('despesas.usuario_id', '=', $user)
        ->select('despesas.id', 'despesas.descricao', 'despesas.valor', 'despesas.tipo_despesa', 'despesas.fixo', 'despesas.data', 'cartao.nome AS nome_cartao', 'categoria.nome AS nome_categoria');

        $data['despesas'] = $despesas->get();

        $data['despT'] = $despesas->sum('valor');

        $data['saldoT'] = $ganhos->sum('valor') - $despesas->sum('valor');

        $data['objetivos'] = Objetivos::where('usuario_id', '=', $user)->get();

        $campos = array();
        foreach ($data as $key => $value) {
            $$key = $value;
            $campos[] = $key;
        }

        return view('dashboard', compact($campos));
    }
}
