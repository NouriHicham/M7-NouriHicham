<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    public function index()
    {
        $pets = Pets::all();
        return response()->json(['pets' => $pets], 200);
    }

    public function store(Request $request)
    {
        $pet = Pets::create($request->all());
        return response()->json(['pet' => $pet], 201);
    }

    public function update(Request $request, Pets $pet)
    {
        $pet->update($request->all());
        return response()->json(['pet' => $pet], 200);
    }

    public function updatePartial(Request $request, Pets $pet)
    {
        $pet->update($request->all());
        return response()->json(['pet' => $pet], 200);
    }

    public function destroy(Pets $pet)
    {
        $pet->delete();
        return response()->json(null, 204);
    }
}
