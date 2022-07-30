<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index() {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => VehicleResource::collection(Vehicle::all())
        ]);
    }

    public function show(Vehicle $vehicle) {
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => VehicleResource::collection(Vehicle::find($vehicle))
        ]);
    }

    public function store(VehicleRequest $request) {
        $vehicle = Vehicle::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'plate_number' => $request->plate_number,
            'insurance_date' => $request->insurance_date
        ]);

        if ($vehicle) {
            return response()->json([
                'status' => 201,
                'success' => true,
                'data' => $vehicle
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'success' => false,
                'data' => $vehicle
            ]);
        }
    }

    public function update(VehicleRequest $request, Vehicle $vehicle) {

        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->insurance_date = $request->insurance_date;

        if ($vehicle->save())
            return response()->json([
                'status' => 200,
                'success' => true,
                'data' => $vehicle
            ]);
        else
            return response()->json([
                'status' => 200,
                'success' => false,
                'data' => []
            ]);
    }

    public function destroy(Vehicle $vehicle) {
        if (isset($vehicle->id)) {
            if ($vehicle->delete()) {
                return response()->json([
                    'status' => 204,
                    'success' => true,
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'status' => 204,
                'success' => false,
                'data' => []
            ]);
        }
    }
}
