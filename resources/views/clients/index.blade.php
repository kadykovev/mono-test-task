@extends('layouts.app')

@section('title', 'Все клиенты')

@section('content')
    @if($clientsNum > 0)
        <h2>Список клиентов и их автомобилей</h2>
        <table class="table align-middle">
            <thead>
                <tr class="table-secondary">
                <th scope="col">Ф.И.О.</th>
                <th scope="col">Автомобиль</th>
                <th scope="col">Модель</th>
                <th scope="col">Модель</th>
                <th scope="col">Цвет</th>
                <th scope="col" colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientsData as $clientData)
                <tr>
                <td>{{$clientData->name}}</td>
                <td>{{$clientData->brand}}</td>
                <td>{{$clientData->model}}</td>
                <td>{{$clientData->color}}</td>
                <td>{{$clientData->license_plate}}</td>
                <td><a class="btn btn-success bi bi-pencil-square" href="{{ route('clients.edit', ['id' => $clientData->id]) }}" role="button"></a></td>
                <td><a class="btn btn-danger bi bi-x-square-fill" href="{{ route('clients.destroy', ['id' => $clientData->carId]) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow" role="button"></a></td>
                </tr>
                <tr>
                @endforeach
            </tbody>
        </table>
    @else
    <h2>Нет ниодного клиента в базе</h2>
    @endif
    {{ $clientsData->links() }}
@endsection


