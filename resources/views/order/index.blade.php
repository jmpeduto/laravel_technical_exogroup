@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Ordenes</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">order
                    <a style="float:right;" href="{{route('pizza.index')}}"><button class="bnt btn-secondary btn-sm" style="margin-left: 5px;">Ver pizza</button></a>
                    <a style="float:right;" href="{{route('pizza.create')}}"><button class="bnt btn-secondary btn-sm">Agregar pizza</button></a>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Usuario</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Fecha/Hora</th>
                                <th scope="col">Pizza</th>
                                <th scope="col">Total($)</th>
                                <th scope="col">Mensaje</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Aceptar</th>
                                <th scope="col">Rechazar</th>
                                <th scope="col">Orden<br>completada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->nombre }}</td>
                                <td >{{ $order->user->email }}<br>{{$order->telefono}}</td>
                                    <td>{{ $order->fecha }}/{{ $order->hora }}</td>
                                    <td>{{ $order->pizza->nombre }}</td>
                                    <td>{{ $order->body }}</td>
                                    <td>{{ $order->estado }}</td>
                                    <form action="{{ route('order.status',$order->id) }}" method="post">@csrf
                                        <td>
                                            <input name="status" type="submit" value="accepted"
                                                class="btn btn-primary btn-sm">
                                        </td>
                                        <td>
                                            <input name="status" type="submit" value="rejected"
                                                class="btn btn-danger btn-sm">
                                        </td>
                                        <td>
                                            <input name="status" type="submit" value="completed"
                                                class="btn btn-success btn-sm">
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
