@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-4">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                        <ul class="list-group">
                            <a href="" class="list-group-item list-group-item-action">Ver</a>
                            <a href="" class="list-group-item list-group-item-action">Crear</a>
                        </ul>

                </div>
            </div>
    </div>
        <div class="col-md-8">
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
                      <label for="descripcion">Ingredientes (pueden ser mas de 1)</label>
                      <select name="" id="" class="form-control" multiple>
                          <option value="pepe">Pepperoni</option>
                          <option value="muzza">Muzzarella</option>
                          <option value="hongo">Hongo</option>
                      </select>
                  </div>
                  <!-- <div class="form-inline">
                      <label for="">Precio($)</label>
                      <input type="number" name="precio" id="" class="form-control" placeholder="Precio total">
                  </div> -->
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
        </div>
</div>
@endsection
