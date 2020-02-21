@extends('layouts.app', ['activePage' => 'categorias', 'titlePage' => 'Categorias'])
@section('title', 'Categorias')

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-lg btn-primary pull-right" href="/categorias/new">NOVO</a>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">Filtrar</h4>
                </div>
                <div class="card-body table-responsive">
                    <form method="get">

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" @if(isset($_REQUEST['nome'])) value="{{$_REQUEST['nome']}}" @endif name="nome" class="form-control">
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Buscar</button>
                            <a href="/categorias" class="btn btn-default">LIMPAR</a>
                        </div>

                    </form>
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title">Suas Categorias</h4>
                  <p class="card-category">Sua listagem de Categorias</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Nome</th>
                      <th>Contabiliza</th>
                      <th>Ações</th>
                    </thead>
                    <tbody>
                        @if(count($categoria)> 0)
                        @foreach($categoria as $item)
                          <tr>
                              <td>{{$item->nome}}</td>
                              <td>@if($item->contabiliza == 0) <span class="text-success">SIM</span> @else <span class="text-danger">NÃO</span> @endif</td>
                              <td><a onclick="return confirm('Você quer mesmo excluir este ganho?')" href="/categorias/delete/{{$item->id}}"><i class="fa fa-trash"></i> Apagar</a></td>
                          </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3" class="text-center">Não há nenhum registro por aqui.</td>
                        </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {

    });
  </script>
@endpush
