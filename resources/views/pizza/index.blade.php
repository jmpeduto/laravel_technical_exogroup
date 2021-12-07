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
                        <a href="" class="list-group-item list-group-item-action">Ordenar</a>
  
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
                                            <td>ingrediente1, ingrediente2</td>
                                            <td>{{ $pizza->precio }}</td>
                                            <td><a href="{{ route('pizza.edit', $pizza->id) }}"><button
                                                        class="btn btn-primary">Editar</button></a></td>
                                            <td><button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal{{ $pizza->id }}">Eliminar</button></td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $pizza->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                {{-- <form action="{{ route('pizza.destroy', $pizza->id) }}" method="post"> --}}
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                    confirmation</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Delete
                                                                </button>
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
                        {{ $pizzas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
