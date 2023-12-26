<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $parkedCars = DB::table('cars')
            ->join('clients', 'cars.client_id', '=', 'clients.id')
            ->select('cars.id', 'cars.brand', 'cars.model', 'cars.color', 'cars.license_plate', 'clients.name')
            ->where('cars.is_parked', '=', true)->paginate(5);

        $parkedCarsNum = DB::table('cars')
            ->select('id', 'brand', 'model', 'color', 'license_plate')
            ->where('is_parked', '=', true)
            ->get()
            ->count();

        $clients = DB::table('clients')
            ->select('id', 'name')
            ->get();

        $clientsNum = $clients->count();

        if ($clientsNum > 0) {
            $firstClientId = $clients->first()->id;
            $clientId = $request->query()['client_id'] ?? $firstClientId;
            $clientIdExists = DB::table('clients')->where('id', '=', $clientId)->exists();

            $selectedClientId = $clientIdExists ? $clientId : $firstClientId;

            $clientCars = DB::table('cars')
                ->select('id', 'brand', 'model', 'license_plate')
                ->where('client_id', '=', $selectedClientId)
                ->get();

            $carId = $request->query()['car_id'] ?? false;
            $isSubmited = $request->query()['add'] ?? false;

            if ($isSubmited && $carId) {
                $carIdExists = DB::table('cars')->where('id', '=', $carId)->exists();

                if ($carIdExists) {
                    DB::table('cars')->where('id', '=', $carId)->update(['is_parked' => true]);

                    return redirect()->route('cars.index');
                }
            }
            return view('cars.index', compact('parkedCars', 'clients', 'clientCars', 'selectedClientId', 'parkedCarsNum', 'clientsNum'));
        } else {
            return view('cars.index', compact('parkedCarsNum', 'clientsNum'));
        }
    }

    public function update($id)
    {
        DB::table('cars')->where('id', '=', $id)->update(['is_parked' => false]);
        return redirect()->route('cars.index');
    }
}
