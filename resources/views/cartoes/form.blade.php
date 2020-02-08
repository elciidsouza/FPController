@extends('layouts.app', ['activePage' => 'cartão', 'titlePage' => 'Adição de Cartão'])
@section('title', 'Cartões')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Adicionar</h4>
                </div>
                <div class="card-body table-responsive">
                    <form method="post" action="/cartoes/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Limite</label>
                            <input type="text" name="limite" class="form-control money" required>
                        </div>

                        <div class="form-group">
                            <label>Data Limite</label>
                            <select class="form-control" data-style="btn btn-link" name="dia_vencimento" required>
                                <option value="">Selecione</option>
                                @for ($i = 0; $i <= $count = 31; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="/cartoes" class="btn btn-danger">Cancelar</a>
                        </div>

                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>
</div>
@endsection
