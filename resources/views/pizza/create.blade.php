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
    <div class="col-md-4">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                        <ul class="list-group">
                            <a href="{{route('pizza.index')}}" class="list-group-item list-group-item-action">Listado</a>
                            <a href="{{route('pizza.create')}}" class="list-group-item list-group-item-action">Crear</a>
                        </ul>

                </div>
            </div>
            @if(count($errors)>0)
            <div class="card mt-3">
                <div class="card-body">
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
    </div>
    <div class="col-md-8">
            <form action="{{route('pizza.store')}}" method="post" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">Pizza</div>
                <div class="card-body">
                  <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" name="nombre" id="" class="form-control" placeholder="Nombre de la pizza">
                  </div>
                  <div class="form-group">
                      <label for="descripcion">Descripcion</label>
                      <textarea name="descripcion" id="" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="ingredientes">Ingredientes (pueden ser mas de 1)</label>
                      <select name="ingredientes[]" id="ingredients" class="form-control" multiple size="10">
                          @foreach ($ingredientes as $ingredient)
                          <option data-precio="{{$ingredient->precio}}" value="{{$ingredient->id}}">{{$ingredient->nombre}}</option>
                          @endforeach
                          {{-- <option value="2">Mozzarella</option>
                          <option value="3">Hongos</option> --}}
                      </select>
                  </div>
                  <div class="form-inline mt-2">
                      <label for="">Precio($)</label>
                      <input type="number" readonly name="precio" id="precio" class="form-control" placeholder="0">
                  </div>
                  <br>
                  <div class="form-group">
                      <label for="imagen">Imagen</label>
                      <input type="file" name="imagen" id="">
                  </div>
                  <div class="form-group text-center">
                      <button class="btn btn-primary" type="submit">Guardar</button>
                  </div>
                </div>
            </div>
        </form>
        </div>
</div>

@endsection
