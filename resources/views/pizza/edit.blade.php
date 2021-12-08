@extends('layouts.app')

@section('content')
<script>
    var precio_total = 0;
    $(document).ready(function(){
    $("#ingredients").click(function(){
        var ingredientes = $(this).find('option:selected');
        precio_total = 0;
        $.map(ingredientes, function(ingrediente){
                precio_total += $(ingrediente).data('precio');
            });
            console.log(precio_total);
            //calcula el precio y le agrega el 0.5 del valor de los ingredientes
            $("#precio").val(precio_total*1.5);
        });
        
    });
</script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (count($errors) > 0)
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                               <p> {{ $error }}<p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">Editar Pizza</div>
                    <form action="{{ route('pizza.update',$pizza->id) }}" method="post" enctype="multipart/form-data">@csrf
                       @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="nombre" placeholder="name of pizza"
                                    value="{{ $pizza->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <textarea class="form-control" name="descripcion">{{ $pizza->descripcion }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="ingredientes">Ingredientes (pueden ser mas de 1)</label>
                                <select name="ingredientes[]" id="ingredients" class="form-control" multiple size="10">
                                    @for($i=0; $i < count($ingredients); $i++)
                                    @if (isset($ingredients[$i]['selected']))
                                        <option data-precio="{{$ingredients[$i]['precio']}}" selected value="{{$ingredients[$i]['id']}}">{{$ingredients[$i]['nombre']}}</option>
                                    @else
                                        <option data-precio="{{$ingredients[$i]['precio']}}" value="{{$ingredients[$i]['id']}}">{{$ingredients[$i]['nombre']}}</option>
                                    @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="form-inline">
                                <label>Precio($)</label>
                                <input type="text" name="precio" id="precio" class="form-control"
                                    placeholder="precio" readonly value="{{ $pizza->precio }}">
                            </div>
                            <div class="form-group">
                                <label>Imagen</label>
                                <input type="file" name="imagen" class="form-control" name="imagen">
                                <img class="mt-2" src="{{ Storage::url($pizza->imagen) }}" width="80">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
