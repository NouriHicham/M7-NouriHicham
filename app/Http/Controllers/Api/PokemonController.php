<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index(){
        $pokemon = pokemon::all();
        return response()->json(['pokemon' => $pokemon], 200);
    }

    public function show($id){
        $pokemon = pokemon::find($id);
        if($pokemon){
            return response()->json(['pokemon' => $pokemon], 200);
        }else{
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

    public function store(Request $request){
        $pokemon = pokemon::create($request->all(), [
            'name' => 'required|string',
            'image' => 'required|url',
        ]);
        return response()->json(['pokemon' => $pokemon], 201);
    }

    public function update(Request $request, $id){
        $pokemon = pokemon::find($id);
        if($pokemon){
            $pokemon->update($request->all(), [
                'name' => 'required|string',
                'image' => 'required|url',
            ]);
            return response()->json(['pokemon' => $pokemon], 200);
        }else{
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

    public function updatePartial(Request $request, $id){
        $pokemon = pokemon::find($id);
        if($pokemon){
            $pokemon->update($request->all(), [
                'name' => 'string',
                'image' => 'url',
            ]);
            return response()->json(['pokemon' => $pokemon], 200);
        }else{
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

    public function destroy($id){
        $pokemon = pokemon::find($id);
        if($pokemon){
            $pokemon->delete();
            return response()->json(['message' => 'Pokemon #' . $id . ' deleted '], 204);
        }else{
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }

}
