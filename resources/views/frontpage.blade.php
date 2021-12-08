@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Menu</div>

                    <div class="card-body">
                      
                        <form action="{{route('frontpage')}}" method="get">
                            <a class="list-group-item list-group-item-action" href="/">Volver</a>

                        </form>
                    
                       
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pizza({{count($pizzas_final)}} pizzas)</div>

                    <div class="card-body">

                        <div class="row">
                            @forelse ($pizzas_final as $pizza )
                                <div class="col-md-4 mt-2 text-center" style="border: 1px solid #ccc;">
                                    <img src="{{ Storage::url($pizza->imagen) }}" class="img-thumbnail" style="width: 100%;">
                                    <p>{{ $pizza->nombre }}</p>
                                    <p>{{ $pizza->descripcion }}</p>
                                {{-- <a href="{{route('pizza.show',$pizza->id)}}"> --}}
                                    <p style="font-weight: bold;">Ingredientes:
                                        <br>
                                    </p>
                                    @foreach ($pizza->ingredients as $ingredient)
                                     <p>{{ $ingredient->ingrediente_nombre }}</p>
                                    @endforeach
                                <a href="">
                                        <button class="btn btn-danger mb-1">Ordenar</button>
                                    </a>
                                </div>
                            @empty
                                <p>No hay pizzas para mostrar</p>

                            @endforelse

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        a.list-group-item {
            font-size: 18px;
        }

        a.list-group-item:hover {
            background-color: red;
            color: #fff;
        }

        .card-header {
            background-color: red;
            color: #fff;
            font-size: 20px;
        }

    </style>
@endsection
