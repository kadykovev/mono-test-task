@extends('layouts.app')

@section('title', 'Редактирование данных клиента')

@section('content')

@php
    $hasErrors = $errors->any() ? true : false;
    $carNumber = 0;
@endphp

@if ($hasErrors)
    @php
        $clientData->name = '';
        $clientData->gender = '';
        $clientData->phone = '';
        $clientData->address = '';
    @endphp
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" class="" action="{{route('clients.update', $clientData->id)}}">
    @csrf
    <input name="_method" type="hidden" value="PATCH">
    <h2>Клиент</h2>
    <fieldset class="p-3 mb-3 border">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Ф.И.О.</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('client.name') is-invalid @enderror" name="client[name]" maxlength="100" value="{{ old('client.name') ?? $clientData->name }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Пол</label>
            <div class="col-sm-10">
                <select class="form-select @error('client.gender') is-invalid @enderror" name="client[gender]">
                    <option></option>
                    <option value="male" {{ (old('client.gender') === 'male' || $clientData->gender === 'male') ? 'selected' : Null }}>Мужской</option>
                    <option value="female" {{ (old('client.gender') === 'female' || $clientData->gender === 'female') ? 'selected' : Null }}>Женский</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Номер телефона</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('client.phone') is-invalid @enderror" name="client[phone]" maxlength="18" value="{{ old('client.phone') ?? $clientData->phone }}">
            </div>
        </div>
        <div class="row">
            <label class="col-sm-2 col-form-label">Адрес</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('client.address') is-invalid @enderror" name="client[address]"  value="{{ old('client.address') ?? $clientData->address }}">
            </div>
        </div>
  </fieldset>
  <h2>Автомобили клиента</h2>

    @foreach ($cars = $clientCars->all() as $clientCar)
        @php
            $id = $clientCar->id;
            $brand = $hasErrors === false ? $clientCar->brand : '';
            $model = $hasErrors === false ? $clientCar->model : '';
            $color = $hasErrors === false ? $clientCar->color : '';
            $licensePlate = $hasErrors === false ? $clientCar->license_plate : '';

            $carNumber += 1;
        @endphp
        <fieldset class="mb-3 p-3 pb-0 w-50 border">
            <legend  class="h4">Автомобиль №{{$carNumber}}</legend>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Марка</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('car.' . $id .  '.brand') is-invalid @enderror" name="car[{{$id}}][brand]" maxlength="50" value="{{ old('car.' . $id . '.brand') ?? $brand }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Модель</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('car.' . $id .  '.model') is-invalid @enderror" name="car[{{$id}}][model]" maxlength="50" value="{{ old('car.' . $id . '.model') ?? $model }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Цвет</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('car.' . $id .  '.color') is-invalid @enderror" name="car[{{$id}}][color]" maxlength="50" value="{{ old('car.' . $id . '.color') ?? $color }}">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Гос. номер</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('car.' . $id .  '.licensePlate') is-invalid @enderror" name="car[{{$id}}][licensePlate]" maxlength="12"  value="{{ old('car.' . $id . '.licensePlate') ?? $licensePlate }}">
                </div>
            </div>
        </fieldset>
    @endforeach

    <h2>Новый автомобиль</h2>
    <fieldset class="mb-3 p-3 pb-0 w-50 border">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Марка</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('newCar.brand') is-invalid @enderror" name="newCar[brand]" maxlength="50" value="{{ old('newCar.brand') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Модель</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('newCar.model') is-invalid @enderror" name="newCar[model]" maxlength="50" value="{{ old('newCar.model') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Цвет</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('newCar.color') is-invalid @enderror" name="newCar[color]" maxlength="50" value="{{ old('newCar.color') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Гос. номер</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('newCar.licensePlate') is-invalid @enderror" name="newCar[licensePlate]" maxlength="12"  value="{{ old('newCar.licensePlate') }}">
            </div>
        </div>
  </fieldset>

  <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
@endsection
