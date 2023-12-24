<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    private $messages = [
        'client.name.required' => 'Поле Имя обязательно для заполнения',
        'client.gender.required' => 'Необходимо указать пол',
        'client.name.between:3,100' => 'Поле Имя должно включать от 3 до 100 символов',
        'client.phone.required'  => 'Поле Телефон обязательно для заполнения',
        'client.phone.unique'  => 'Такой номер уже существует в базе',
        'client.phone'  => 'Неверный формат телефонного номера',
        'client.address.required' => 'Поле Адрес обязательно для заполнения',

        'car.brand.required' => 'Поле Марка обязательно для заполнения',
        'car.model.required' => 'Поле Модель обязательно для заполнения',
        'car.color.required' => 'Поле Цвет обязательно для заполнения',
        'car.licensePlate.required' => 'Поле Гос. номер обязательно для заполнения',
        'car.licensePlate.alpha_num' => 'Поле Гос. номер должен содержать только буквы и цифры',
        'car.licensePlate.unique:cars,license_plate' => 'Данный Гос. номер уже существует в базе',

        'car.*.brand.required' => 'Поле Марка обязательно для заполнения',
        'car.*.model.required' => 'Поле Модель обязательно для заполнения',
        'car.*.licensePlate.required' => 'Поле Гос. номер обязательно для заполнения',
        'car.*.licensePlate.alpha_num' => 'Поле Гос. номер должен содержать только буквы и цифры',

        'newCar.brand.required' => 'Поле Марка обязательно для заполнения',
        'newCar.model.required' => 'Поле Модель обязательно для заполнения',
        'newCar.color.required' => 'Поле Цвет обязательно для заполнения',
        'newCar.licensePlate.alpha_num' => 'Поле Гос. номер должен содержать только буквы и цифры',
        'newCar.licensePlate.required' => 'Поле Гос. номер обязательно для заполнения',
        'newCar.licensePlate.unique:cars,license_plate' => 'Данный Гос. номер уже существует в базе',

    ];

    public function index()
    {
        $clientsData = DB::table('clients')
            ->join('cars', 'clients.id', '=', 'cars.client_id')
            ->select('clients.id', 'clients.name', 'cars.id AS carId', 'cars.brand', 'cars.model', 'cars.color', 'cars.license_plate')
            ->paginate(5);

        $clientsNum = DB::table('clients')
            ->select('*')
            ->get()
            ->count();

        return view('clients.index', compact('clientsData', 'clientsNum'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function edit($id)
    {
        $clientData = DB::table('clients')
            ->select('id', 'name', 'gender', 'phone', 'address')
            ->where('id', '=', $id)
            ->first();

        $clientCars = DB::table('cars')
            ->select('id', 'brand', 'model', 'color', 'license_plate')
            ->where('client_id', '=', $id)
            ->get();

        return view('clients.edit', compact('clientData', 'clientCars'));
    }

    public function store(Request $request)
    {
        $data = $this->validate(
            $request,
            [
                'client.name' => 'required|string|between:3,100',
                'client.gender' => 'required|in:male,female',
                'client.phone' => 'required|phone:mobile|unique:clients,phone',
                'client.address' => 'required|string',

                'car.brand' => 'required|string|max:50',
                'car.model' => 'required|string|max:50',
                'car.color' => 'required|string|max:50',
                'car.licensePlate' => 'required|alpha_num|unique:cars,license_plate|max:12'
            ],
            $this->messages
        );

        extract($data);

        $id = DB::table('clients')->insertGetId(
            [
                'name' => $client['name'],
                'gender' => $client['gender'],
                'phone' => $client['phone'],
                'address' => $client['address']
            ]
        );

        DB::table('cars')->insert(
            [
                'client_id' => $id,
                'brand' => $car['brand'],
                'model' => $car['model'],
                'color' => $car['color'],
                'license_plate' => $car['licensePlate']
            ]
        );

        return redirect()->route('clients.index');
    }

    public function update(Request $request, $id)
    {
        $isNewCarFilled = ! collect($request->newCar)->every(fn ($value, $key) => $value === null);

        $data['client'] = $request->client;
        $data['car'] = $request->car;

        if (!$isNewCarFilled) {
            $request->offsetUnset('newCar');
        }

        $data = $this->validate(
            $request,
            [
                'client.name' => 'required|string|between:3,100',
                'client.gender' => 'required|in:male,female',
                'client.phone' => [
                    'required',
                    'phone:mobile',
                    Rule::unique('clients', 'phone')->ignore($id)
                ],
                'client.address' => 'required|string',

                'car.*.brand' => 'required|string|max:50',
                'car.*.model' => 'required|string|max:50',
                'car.*.color' => 'required|string|max:50',
                'car.*.licensePlate' => [
                    'required',
                    'max:12',
                    'alpha_num',
                    function ($attribute, $value, $fail) {
                        $rows = DB::table('cars')
                            ->select('id')
                            ->where(
                                [
                                    ['license_plate', '=', $value],
                                    ['id', '<>', explode('.', $attribute)[1]]
                                ]
                            )
                            ->get();

                        if ((bool) count($rows)) {
                            $fail('Данный Гос. номер уже существует в базе');
                        }
                    }
                ],

                'newCar.brand' => 'sometimes|required|string|max:50',
                'newCar.model' => 'sometimes|required|string|max:50',
                'newCar.color' => 'sometimes|required|string|max:50',
                'newCar.licensePlate' => 'sometimes|required|alpha_num|unique:cars,license_plate|max:12'
            ],
            $this->messages
        );

        extract($data);

        DB::table('clients')->where('id', $id)->update(
            [
                'name' => $client['name'],
                'gender' => $client['gender'],
                'phone' => $client['phone'],
                'address' => $client['address']
            ]
        );

        foreach ($car as $carId => $clientCar) {
            DB::table('cars')->where('id', $carId)->update(
                [
                    'brand' => $clientCar['brand'],
                    'model' => $clientCar['model'],
                    'color' => $clientCar['color'],
                    'license_plate' => $clientCar['licensePlate']
                ]
            );
        }

        if ($isNewCarFilled) {
            DB::table('cars')->insert(
                [
                    'client_id' => $id,
                    'brand' => $newCar['brand'],
                    'model' => $newCar['model'],
                    'color' => $newCar['color'],
                    'license_plate' => $newCar['licensePlate']
                ]
            );
        }

        return redirect()->route('clients.index');
    }

    public function destroy(Request $request, $id)
    {
        $clientId = DB::table('cars')
            ->select('client_id')
            ->where('id', '=', $id)
            ->get()->first()
            ->client_id;

        $carsNum = DB::table('cars')
            ->select('id')
            ->where('client_id', '=', $clientId)
            ->get();

        DB::table('cars')
            ->where('id', '=', $id)
            ->delete();

        if ($carsNum->count() === 1) {
            DB::table('clients')
                ->where('id', '=', $clientId)
                ->delete();
        }

        return redirect()->route('clients.index');
    }
}
