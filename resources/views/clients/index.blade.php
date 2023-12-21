@extends('layouts.app')

@section('title', 'Все клиенты')

@section('content')
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Ф.И.О.</th>
            <th scope="col">Автомобиль</th>
            <th scope="col">Гос. номер</th>
            <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientsData as $clientData)
            <tr>
            <td>{{$clientData->name}}</td>
            <td>{{$clientData->brand}}</td>
            <td>{{$clientData->license_plate}}</td>
            <td><a class="btn btn-primary" href="{{ route('clients.edit', ['id' => $clientData->id]) }}" role="button">Редактировать</a></td>
            <td>@mdo</td>
            </tr>
            <tr>
            @endforeach
        </tbody>
    </table>
@endsection
