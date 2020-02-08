@extends('layouts.app', ['activePage' => 'despesas', 'titlePage' => 'Despesas'])
@section('title', 'Despesas')

@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-lg btn-primary pull-right" href="/despesas/new">NOVO</a>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Filtrar</h4>
                </div>
                <div class="card-body table-responsive">
                    <form method="get">
                        
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" @if(isset($_REQUEST['descricao'])) value="{{$_REQUEST['descricao']}}" @endif name="descricao" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Mês</label>
                            <select class="form-control" data-style="btn btn-link" name="mes">
                                <option value="">Selecione</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '01') selected @endif value="01">Janeiro</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '02') selected @endif value="02">Fevereiro</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '03') selected @endif value="03">Março</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '04') selected @endif value="04">Abril</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '05') selected @endif value="05">Maio</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '06') selected @endif value="06">Junho</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '07') selected @endif value="07">Julho</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '08') selected @endif value="08">Agosto</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '09') selected @endif value="09">Setembro</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '10') selected @endif value="10">Outubro</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '11') selected @endif value="11">Novembro</option>
                                <option @if(isset($_REQUEST['mes']) && $_REQUEST['mes'] == '12') selected @endif value="12">Dezembro</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Ano</label>
                            <select class="form-control" data-style="btn btn-link" name="ano">
                                <option value="">Selecione</option>
                                @for($ano = 2020; $ano <= date('Y'); $ano++)
                                      <option @if(isset($_REQUEST['ano']) && $_REQUEST['ano'] == $ano) selected @endif value="{{$ano}}">{{$ano}}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Buscar</button>
                            <a href="/despesas" class="btn btn-default">LIMPAR</a>
                        </div>
                        
                    </form>
                </div>
              </div>
            </div>
            
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Suas despesas</h4>
                  <p class="card-category">Sua listagem de despesas</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Descrição</th>
                      <th>Data</th>
                      <th>Tipo</th>
                      <th>Fixo</th>
                      <th>Categoria</th>
                      <th>Cartão</th>
                      <th>Valor</th>
                      <th>Ações</th>
                    </thead>
                    <tbody>
                        @if(count($despesas)> 0)
                          @foreach($despesas as $despesa)
                            <tr>
                                <td>{{$despesa->descricao}}</td>
                                <td>@if($despesa->data == null) - @else {{date_format(date_create($despesa->data), 'd/m/Y')}} @endif</td>
                                <td>{{$despesa->tipo_despesa}}</td>
                                <td>@if($despesa->fixo == 1) <span class="text-success">SIM</span> @else <span class="text-danger">NÃO</span> @endif</td>
                                <td>{{$despesa->nome_categoria}}</td>
                                <td>{{$despesa->nome_cartao}}</td>
                                <td>R$ {{number_format($despesa->valor, 2, ',', '.')}}</td>
                                <td><a onclick="return confirm('Você quer mesmo excluir este despesa?')" href="/despesas/delete/{{$despesa->id}}"><i class="fa fa-trash"></i> Apagar</a></td>
                            </tr>
                          @endforeach
                        <tr class="table-secondary">
                            <td colspan="6">TOTAL</td>
                            <td colspan="2">R$ {{number_format($despesasTotal, 2, ',', '.')}}</td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="8" class="text-center">Não há nenhum registro por aqui.</td>
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