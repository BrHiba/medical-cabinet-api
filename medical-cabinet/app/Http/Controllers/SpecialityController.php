<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function index()
    {
        return response()->json(Speciality::all());
    }

    public function show($id)
    {
        $speciality = Speciality::find($id);
        if (!$speciality) {
            return response()->json(['message' => 'Spécialité non trouvée'], 404);
        }
        return response()->json($speciality);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:specialities',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $speciality = Speciality::create($request->all());

        return response()->json($speciality, 201);
    }

    public function update(Request $request, $id)
    {
        $speciality = Speciality::find($id);
        if (!$speciality) {
            return response()->json(['message' => 'Spécialité non trouvée'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|unique:specialities,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $speciality->update($request->all());

        return response()->json($speciality);
    }

    public function destroy($id)
    {
        $speciality = Speciality::find($id);
        if (!$speciality) {
            return response()->json(['message' => 'Spécialité non trouvée'], 404);
        }

        $speciality->delete();

        return response()->json(['message' => 'Spécialité supprimée avec succès']);
    }
}
