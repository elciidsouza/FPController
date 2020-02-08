@extends('layouts.app', ['activePage' => 'objetivos', 'titlePage' => 'Objetivos'])
@section('title', 'Objetivos')

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-lg btn-success pull-right" href="/objetivos/new">NOVO</a>
            </div>
            
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Seus objetivos</h4>
                  <p class="card-category">Sua listagem de objetivos</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Descrição</th>
                      <th>Prazo</th>
                      <th>Realizado</th>
                      <th>Valor</th>
                      <th>Ações</th>
                    </thead>
                    <tbody>
                        @if(count($objetivos)> 0)
                          @foreach($objetivos as $objetivo)
                            <tr>
                                <td>{{$objetivo->descricao}}</td>
                                <td>@if($objetivo->prazo == null) - @else {{date_format(date_create($objetivo->prazo), 'd/m/Y')}} @endif</td>
                                <td>@if($objetivo->realizado == 1) <span class="text-success">SIM</span> @else <span class="text-danger">NÃO</span> @endif</td>
                                <td>R$ {{number_format($objetivo->valor, 2, ',', '.')}}</td>
                                <td>
                                    @if($objetivo->realizado == 0)
                                    <a class="text-success" onclick="return confirm('Você quer marcar este objetivo como realizado?')" href="/objetivos/realizado/{{$objetivo->id}}"><i class="fa fa-check"></i> Realizado</a>
                                    @endif
                                    <a onclick="return confirm('Você quer mesmo excluir este objetivo?')" href="/objetivos/delete/{{$objetivo->id}}"><i class="fa fa-trash"></i> Apagar</a>
                                </td>
                            </tr>
                          @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">Não há nenhum registro por aqui.</td>
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