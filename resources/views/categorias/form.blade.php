@extends('layouts.app', ['activePage' => 'categorias', 'titlePage' => 'Adição de Categorias'])
@section('title', 'Categorias')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-success ">
                  <h4 class="card-title">Adicionar</h4>
                </div>
                <div class="card-body table-responsive">
                    <form method="post" action="/categorias/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        
                        <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" name="contabiliza">
                              Não contabilizar do total
                              <span class="form-check-sign">
                                  <span class="check"></span>
                              </span>
                          </label>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="/categorias" class="btn btn-danger">Cancelar</a>
                        </div>

                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>
</div>
@endsection

