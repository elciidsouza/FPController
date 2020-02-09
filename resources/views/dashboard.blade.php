@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('title')
    Dashboard
@stop

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">attach_money</i>
              </div>
              <p class="card-category">Ganhos</p>
              <h3 class="card-title">@if(isset($valorT)) R$ {{ number_format($valorT, 2, ',', '.') }} @endif
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                  <i class="material-icons">attach_money</i>
                  <a href="/ganhos">Detalhar ganhos</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">work</i>
              </div>
              <p class="card-category">Saldo</p>
              <h3 class="card-title">@if(isset($saldoT)) R$ {{ number_format($saldoT, 2, ',', '.') }} @endif</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">work</i> Seu saldo total
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">money_off</i>
              </div>
              <p class="card-category">Despesas</p>
              <h3 class="card-title">@if(isset($despT)) R$ {{ number_format($despT, 2, ',', '.') }} @endif</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                  <i class="material-icons">money_off</i>
                  <a href="/despesas"> Ver todas as despesas</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--<div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Completed Tasks</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>-->
        <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Objetivos</h4>
                  <p class="card-category">Sua listagem de objetivos</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Objetivo</th>
                      <th>Valor</th>
                      <th>Prazo</th>
                      <th>Realizado</th>
                    </thead>
                    <tbody>
                        @if (count($objetivos) > 0)
                        @foreach ($objetivos as $item)
                            <tr>
                                <td>{{ $item->descricao }}</td>
                                <td>R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                                <td>{{ date("d/m/Y", strtotime($item->prazo)) }}</td>
                                <td>@if($item->realizado == 1) <span class="text-success">SIM</span> @else <span class="text-danger">NÃO</span> @endif</td>
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
                  <span class="col-md-12 text-center"><a href="objetivos" class="btn btn-success text-white">VER TODOS</a></span>
              </div>
            </div>

            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Despesas</h4>
                  <p class="card-category">Sua listagem de despesas</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Despesa</th>
                      <th>Valor</th>
                      <th>Data</th>
                      <th>Categoria</th>
                      <th>Tipo</th>
                      <th>Cartão</th>
                    </thead>
                    <tbody>
                        @if (count($despesas) > 0)
                            @foreach ($despesas as $item)
                                <tr>
                                    <td>{{ $item->descricao }}</td>
                                    <td>R$ {{ number_format($item->item_valor, 2, ',', '.') }}</td>
                                    <td>{{$item->data}}</td>
                                    <td>{{ $item->nome_categoria }}</td>
                                    <td>{{ $item->tipo_despesa }}</td>
                                    <td>{{ $item->nome_cartao }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Não há nenhum registro por aqui.</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
                  <span class="col-md-12 text-center"><a href="/despesas" class="btn btn-danger text-white">VER TODOS</a></span>
              </div>
            </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
