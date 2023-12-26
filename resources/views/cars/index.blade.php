@extends('layouts.app')

@section('title', 'Автомобили на стоянке')

@section('content')
    @if($clientsNum == 0)
        <h2>Нет ниодного клиента в базе</h2>
    @else
        <h2>На стоянке: <span class="text-danger">{{$parkedCarsNum}}</span> автомобилей</h2>
        <form method="get" class="row g-3 mb-5" action="{{route('cars.index')}}">
            @csrf
            <div class="col-md-5">
            <label class="form-label">Ф.И.О.</label>
                <select name="client_id" class="form-select" onchange="this.form.submit()">
                    @foreach($clients as $client)
                        <option value="{{$client->id}}" {{ ($client->id == $selectedClientId) ? 'selected' : Null}}>{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Автомобиль</label>
                <select name="car_id" class="form-select">
                    @foreach($clientCars as $car)
                        <option value="{{$car->id}}">{{$car->brand}} {{$car->model}} Гос. номер - {{$car->license_plate}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
            <label class="form-label">&nbsp</label>
                <button type="submit" class="btn btn-primary w-100" name="add" value="{{$car->id}}">Добавить</button>
            </div>
        </form>
        @if($parkedCarsNum > 0)
            <h2>Список автомобилей находящихся на стоянке</h2>
            <table class="table align-middle">
                <thead>
                    <tr class="table-secondary">
                    <th scope="col">Марка</th>
                    <th scope="col">Модель</th>
                    <th scope="col">Цвет</th>
                    <th scope="col">Гос. номер</th>
                    <th scope="col">Владелец</th>
                    <th scope="col" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parkedCars as $car)
                    <tr>
                    <td>{{$car->brand}}</td>
                    <td>{{$car->model}}</td>
                    <td>{{$car->color}}</td>
                    <td>{{$car->license_plate}}</td>
                    <td>{{$car->name}}</td>
                    <td><a class="btn btn-danger bi bi-x-square-fill" href="{{ route('cars.update', ['id' => $car->id]) }}" data-confirm="Вы уверены?" data-method="patch" rel="nofollow" role="button"></a></td>
                    </tr>
                    <tr>
                    @endforeach
                </tbody>
            </table>
            {{ $parkedCars->links() }}
        @endif
    @endif
@endsection
