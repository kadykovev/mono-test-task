@extends('layouts.app')

@section('title', 'Новый клиент')

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
<form method="post" action="{{route('clients.store')}}">
    @csrf
    <fieldset class="row mb-3">
        <legend>Клиент</legend>
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Ф.И.О.</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" maxlength="100" value="{{ old('name') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="gender" class="col-sm-2 col-form-label">Пол</label>
            <div class="col-sm-10">
                <select class="form-select" id="gender" name="gender">
                    <option></option>
                    <option value="male" {{ old('gender') === 'male' ? 'selected' : Null }}>Мужской</option>
                    <option value="female" {{ old('gender') === 'female' ? 'selected' : Null }}>Женский</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="phone" class="col-sm-2 col-form-label">Номер телефона</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="phone"  name="phone" maxlength="18" value="{{ old('phone') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Адрес</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address"  value="{{ old('address') }}">
            </div>
        </div>
  </fieldset>

  <fieldset class="row mb-3">
    <legend>Автомобиль</legend>
        <div class="row mb-3">
            <label for="brand" class="col-sm-2 col-form-label">Марка</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="brand" name="brand" maxlength="50" value="{{ old('brand') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="model" class="col-sm-2 col-form-label">Модель</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="model" name="model" maxlength="50" value="{{ old('model') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="color" class="col-sm-2 col-form-label">Цвет</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="color" name="color" maxlength="50" value="{{ old('color') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="license-plate" class="col-sm-2 col-form-label">Гос. номер</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="license-plate" name="license-plate" maxlength="12"  value="{{ old('license-plate') }}">
            </div>
        </div>
  </fieldset>

  <button type="submit" class="btn btn-primary">Создать</button>
</form>
@endsection
