@extends('layouts.app')

@section('title', 'Новый клиент')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="m-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{route('clients.store')}}">
    @csrf
    <h2>Клиент</h2>
    <fieldset class="p-3 pb-0 mb-3 border">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Ф.И.О.</label>
            <div class="col-sm-10">
                <input type="text" class="form-control  @error('client.name') is-invalid @enderror" name="client[name]" maxlength="100" value="{{ old('client.name') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Пол</label>
            <div class="col-sm-10">
                <select class="form-select   @error('client.gender') is-invalid @enderror" name="client[gender]">
                    <option></option>
                    <option value="male" {{ old('client.gender') === 'male' ? 'selected' : Null }}>Мужской</option>
                    <option value="female" {{ old('client.gender') === 'female' ? 'selected' : Null }}>Женский</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Номер телефона</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('client.phone') is-invalid @enderror" name="client[phone]" maxlength="18" value="{{ old('client.phone') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Адрес</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('client.address') is-invalid @enderror" name="client[address]"  value="{{ old('client.address') }}">
            </div>
        </div>
  </fieldset>

  <h2>Автомобиль</h2>
  <fieldset class="p-3 pb-0 mb-3 border w-50">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Марка</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('car.brand') is-invalid @enderror" name="car[brand]" maxlength="50" value="{{ old('car.brand') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Модель</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('car.model') is-invalid @enderror" name="car[model]" maxlength="50" value="{{ old('car.model') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Цвет</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('car.color') is-invalid @enderror" name="car[color]" maxlength="50" value="{{ old('car.color') }}">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Гос. номер</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('car.licensePlate') is-invalid @enderror" name="car[licensePlate]" maxlength="12"  value="{{ old('car.licensePlate') }}">
            </div>
        </div>
  </fieldset>

  <button type="submit" class="btn btn-primary">Создать</button>
</form>
@endsection
