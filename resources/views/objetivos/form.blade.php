@extends('layouts.app', ['activePage' => 'objetivos', 'titlePage' => 'Adicionar Objetivo'])
@section('title', 'Adicionar Objetivo')

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
                    <form method="post" action="/objetivos/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control money" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Prazo</label>
                            <input type="date" name="data" id="data" class="form-control" value="{{date("Y-m-d")}}">
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="/objetivos" class="btn btn-danger">Cancelar</a>
                        </div>

                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
$(document).ready(function($){
    $('.money').mask('###0.00', {reverse: true});
    $('#fixo').change(function(){
        if(this.checked){
            $('#data').attr('disabled', 'true');
        } else {
            $('#data').removeAttr("disabled")
        }
    });
});
</script>
@endpush