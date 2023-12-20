<?php

namespace App\Http\Controllers\Сlients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $clients = DB::table('clients')
            ->join('cars', 'clients.id', '=', 'cars.client_id')
            ->select('clients.name', 'cars.brand', 'cars.license_plate')
            ->get();
        //dd($clients);
        return view('clients.index', $clients);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate(
            $request,
            [
                'name' => 'required|between:3,100',
                'gender' => 'required|in:male,female',
                'phone' => 'required|phone:mobile',
                'address' => 'required',

                'brand' => 'required|max:50',
                'model' => 'required|max:50',
                'color' => 'required|max:50',
                'license-plate' => 'required|unique:cars,license_plate|max:12'
            ],
            [
                'name.required' => 'Поле Имя обязательно для заполнения',
                'name.between:3,100' => 'Поле Имя должно включать от 3 до 100 символов',
                'phone.required'  => 'Поле Телефон обязательно для заполнения',
                'phone.phone:mobile'  => 'Неверный формат телефонного номера',
                'address.required' => 'Поле Адрес обязательно для заполнения',
                'brand.required' => 'Поле Марка обязательно для заполнения',
                'model.required' => 'Поле Модель обязательно для заполнения',
                'license-plate.required' => 'Поле Гос. номер обязательно для заполнения',
                'license-plate.unique:cars,license_plate' => 'Данный Гос. номер уже существует в базе'

            ]
        );

        $id = DB::table('clients')->insertGetId(
            [
                'name' => $data['name'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ]
        );

        DB::table('cars')->insertGetId(
            [
                'client_id' => $id,
                'brand' => $data['brand'],
                'model' => $data['model'],
                'color' => $data['color'],
                'license_plate' => $data['license-plate']
            ]
        );

        return redirect()->route('clients.index');
    }
}
