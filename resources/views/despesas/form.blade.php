@extends('layouts.app', ['activePage' => 'despesas', 'titlePage' => 'Adicionar Despesa'])
@section('title', 'Adicionar despesa')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Adicionar</h4>
                </div>
                <div class="card-body table-responsive">
                    <form method="post" action="/despesas/send">
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
                            <label>Data</label>
                            <input type="date" name="data" id="data" class="form-control" value="{{date("Y-m-d")}}" required>
                        </div>
                        
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="fixo" id="fixo">
                                Fixo
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                            <label class="form-check-label ml-4">
                                <input class="form-check-input" type="checkbox" name="parcelado" id="parcelado">
                                Parcelado?
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        
                        <div class="form-group mt-4" style="display: none;" id="parcelas">
                            <label>Quantidade de parcelas</label>
                            <input type="number" name="parcelas" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" data-style="btn btn-link" name="tipo_despesa" required>
                                <option>DÉBITO</option>
                                <option>CRÉDITO</option>
                                <option>Á VISTA</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Cartão</label>
                            <select class="form-control" data-style="btn btn-link" name="cartao_id">
                                <option value="">Nenhum</option>
                                @foreach($cartoes as $cartao)
                                <option value="{{$cartao->id}}">{{$cartao->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control" data-style="btn btn-link" name="categoria_id">
                                <option value="">Nenhum</option>
                                @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a href="/despesas" class="btn btn-danger">Cancelar</a>
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
            $('#data').removeAttr('disabled');
        }
    });
    $('#parcelado').change(function(){
        if(this.checked){
            $('#fixo').prop('checked', false);
            $('#fixo').attr('disabled', 'true');
            $('#parcelas').removeAttr('style');
            $(this).attr("required", true);
        } else {
            $('#fixo').removeAttr('disabled');
            $('#parcelas').css('display', 'none');
            $(this).attr("required", false);
        }
    });
});
</script>
@endpush