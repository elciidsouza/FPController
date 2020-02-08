@extends('layouts.app', ['activePage' => 'ganhos', 'titlePage' => 'Adicionar Ganhos'])
@section('title', 'Adicionar ganhos')

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
                    <form method="post" action="/ganhos/send">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control money">
                        </div>
                        
                        <div class="form-group">
                            <label>Data</label>
                            <input type="date" name="data" id="data" class="form-control" value="{{date("Y-m-d")}}">
                        </div>
                        
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="fixo" id="fixo">
                                Fixo
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="/ganhos" class="btn btn-danger">Cancelar</a>
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