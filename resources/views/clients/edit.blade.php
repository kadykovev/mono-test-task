@extends('layouts.app')

@section('title', 'Редактирование данных клиента')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{route('clients.update', $clientData->id)}}">
    @csrf
    <input name="_method" type="hidden" value="PATCH">
    <fieldset class="row mb-3">
        <legend>Клиент</legend>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Ф.И.О.</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" maxlength="100" value="{{ old('name') ?? $clientData->name }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="gender" class="col-sm-2 col-form-label">Пол</label>
            <div class="col-sm-10">
                <select class="form-select" id="gender" name="gender">
                    <option></option>
                    <option value="male" {{ (old('gender') === 'male' || $clientData->gender === 'male') ? 'selected' : Null }}>Мужской</option>
                    <option value="female" {{ (old('gender') === 'female' || $clientData->gender === 'female') ? 'selected' : Null }}>Женский</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Номер телефона</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="phone"  name="phone" maxlength="18" value="{{ old('phone') ?? $clientData->phone }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Адрес</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address"  value="{{ old('address') ?? $clientData->address }}">
            </div>
        </div>
  </fieldset>

  <fieldset class="row mb-3 border">
    <legend>Автомобили</legend>
        @foreach ($clientCars->all() as $clientCar)
        @php
            $id = $clientCar->id;
            $brand = $clientCar->brand;
            $model = $clientCar->model;
            $color = $clientCar->color;
            $license_plate = $clientCar->license_plate;
        @endphp
            <div class="row mb-3">
                <label for="brand" class="col-sm-2 col-form-label">Марка</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="brand" name="brand_{{$id}}" maxlength="50" value="{{ old('brand_' . $id) ?? $brand }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="model" class="col-sm-2 col-form-label">Модель</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="model" name="model_{{$id}}" maxlength="50" value="{{ old('model_' . $id) ?? $model }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="color" class="col-sm-2 col-form-label">Цвет</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="color" name="color_{{$id}}" maxlength="50" value="{{ old('color_' . $id) ?? $color }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="license-plate" class="col-sm-2 col-form-label">Гос. номер</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="license-plate" name="license-plate_{{$id}}" maxlength="12"  value="{{ old('license-plate_' . $id) ?? $license_plate }}">
                </div>
            </div>
        @endforeach
        <div class="row mb-3">
            <label for="brand" class="col-sm-2 col-form-label">Марка</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="brand" name="new-brand" maxlength="50" value="{{ old('new-brand') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="model" class="col-sm-2 col-form-label">Модель</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="model" name="new-model" maxlength="50" value="{{ old('new-model') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="color" class="col-sm-2 col-form-label">Цвет</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="color" name="new-color" maxlength="50" value="{{ old('new-color') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="license-plate" class="col-sm-2 col-form-label">Гос. номер</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="license-plate" name="new-license-plate" maxlength="12"  value="{{ old('new-license-plate') }}">
            </div>
        </div>
  </fieldset>

  <button type="submit" class="btn btn-primary">Редактировать</button>
</form>
@endsection
