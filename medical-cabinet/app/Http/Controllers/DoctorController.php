<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller {
    // Récupérer tous les docteurs
    public function index() {
        return response()->json(Doctor::all(), 200);
    }

    // Récupérer un seul docteur
    public function show($id) {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }
        return response()->json($doctor, 200);
    }

    // Ajouter un docteur
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'speciality' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|unique:doctors,email',
            'description' => 'nullable|string',
            'photo' => 'nullable|string'
        ]);

        $doctor = Doctor::create($request->all());
        return response()->json($doctor, 201);
    }

    // Modifier un docteur
    public function update(Request $request, $id) {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'speciality' => 'string|max:255',
            'phone' => 'string|max:20',
            'email' => 'string|email|unique:doctors,email,' . $doctor->id,
            'description' => 'nullable|string',
            'photo' => 'nullable|string'
        ]);

        $doctor->update($request->all());
        return response()->json($doctor, 200);
    }

    // Supprimer un docteur
    public function destroy($id) {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor not found'], 404);
        }

        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted'], 200);
    }
}
