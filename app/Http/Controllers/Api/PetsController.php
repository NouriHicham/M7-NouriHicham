<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pets = $user->pets;
        return response()->json(['pets' => $pets], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $pet = Pets::create($data);
        return response()->json(['pet' => $pet], 201);
    }

    public function update(Request $request, Pets $pet)
    {
        $user = Auth::user();
        if ($pet->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $pet->update($request->all());
        return response()->json(['pet' => $pet], 200);
    }

    public function updatePartial(Request $request, Pets $pet)
    {
        $user = Auth::user();
        if ($pet->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $pet->update($request->all());
        return response()->json(['pet' => $pet], 200);
    }

    public function destroy(Pets $pet)
    {
        $user = Auth::user();
        if ($pet->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $pet->delete();
        return response()->json(null, 204);
    }

    public function userPets($userId)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $pets = User::findOrFail($userId)->pets;
        return response()->json(['pets' => $pets], 200);
    }
}
