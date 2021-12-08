@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Menu Pizza</div>
                    <div class="card-body">
                        <ul class="list-group">
                        <a href="{{route('pizza.index')}}" class="list-group-item list-group-item-action">Listado</a>
                        <a href="{{route('pizza.create')}}" class="list-group-item list-group-item-action">Crear</a>
                        {{-- <a href="{{route('user.order')}}" class="list-group-item list-group-item-action">User order</a> --}}
                        <a href="{{route('user.order')}}" class="list-group-item list-group-item-action">Ordenes</a>
  
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Listado de pizzas
                        <a href="{{ route('pizza.create') }}">
                            <button class="btn btn-success" style="float: right">Agregar pizza</button>
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (session('message_delete'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('message_delete') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Ingredientes</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pizzas) > 0)
                                    @foreach ($pizzas as $key => $pizza)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td><img src="{{ Storage::url($pizza->imagen) }}" width="80"></td>
                                            <td>{{ $pizza->nombre }}</td>
                                            <td>{{ $pizza->descripcion }}</td>
                                            <td>
                                                @php
                                                    $ingredientes_ = array();
                                                @endphp
                                                @foreach ($pizza->ingredientes as $pizza_ingredient)
                                                @php
                                                    array_push($ingredientes_, $pizza_ingredient->ingrediente_nombre);
                                                @endphp
                                                @endforeach
                                                @php
                                                    echo implode( ', ', $ingredientes_ );
                                                @endphp
                                                
                                            </td>
                                            <td>{{ $pizza->precio }}</td>
                                            <td><a href="{{ route('pizza.edit', $pizza->id) }}"><button
                                                        class="btn btn-primary">Editar</button></a></td>
                                            <td><button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $pizza->id }}">Eliminar</button></td>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $pizza->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('pizza.destroy', $pizza->id) }}" method="post">
        @csrf
        @method('DELETE')
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Esta seguro de eliminar la pizza?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
    </form>
  </div>

                                            
                                        </tr>
                                    @endforeach

                                @else
                                    <p>No hay pizzas para mostrar</p>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="" style="position: relative; left: 10px;">
                    {{ $pizzas->links("pagination::bootstrap-4") }}
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
