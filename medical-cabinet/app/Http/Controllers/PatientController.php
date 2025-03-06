<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index() {
        return response()->json(Patient::all(), 200);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients',
            'password' => 'required|min:6',
            'phone' => 'required|numeric',
        ]);

        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return response()->json($patient, 201);
    }

    public function show($id) {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }
        return response()->json($patient, 200);
    }

    public function update(Request $request, $id) {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:patients,email,' . $id,
            'password' => 'nullable|min:6',
            'phone' => 'required|numeric',
        ]);

        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        if ($request->password) {
            $patient->password = Hash::make($request->password);
        }
        $patient->save();

        return response()->json($patient, 200);
    }

    public function destroy($id) {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Patient not found'], 404);
        }

        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully'], 200);
    }



}   