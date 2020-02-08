@extends('layouts.app', ['activePage' => 'ganhos', 'titlePage' => 'Ganhos'])
@section('title', 'Ganhos')

@section('content')
  <div class="content">
    <div class="container-fluid">
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
            <div class="col-lg-12">
                <a class="btn btn-lg btn-success pull-right" href="/ganhos/new">NOVO</a>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Filtrar</h4>
                </div>
                <div class="card-body table-responsive">
                    <form method="get">
                        
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control">
                        </div>
                        
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info">Buscar</button>
                            <a href="/ganhos" class="btn btn-default">LIMPAR</a>
                        </div>
                        
                    </form>
                </div>
              </div>
            </div>
            
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Seus Ganhos</h4>
                  <p class="card-category">Sua listagem de ganhos</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Descrição</th>
                      <th>Valor</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Salário</td>
                        <td>R$ 1600.00</td>
                      </tr>
                        <tr class="table-secondary">
                            <td>TOTAL</td>
                            <td>R$ 1600.00</td>
                        </tr>
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
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush