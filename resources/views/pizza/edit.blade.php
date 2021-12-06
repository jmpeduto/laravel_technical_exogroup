@extends('layouts.app')

@section('content')
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
                                <input type="text" class="form-control" name="name" placeholder="name of pizza"
                                    value="{{ $pizza->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <textarea class="form-control" name="description">{{ $pizza->descripcion }}</textarea>
                            </div>
                            <div class="form-inline">
                                <label>Precio($)</label>
                                <input type="text" name="precio" class="form-control"
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
