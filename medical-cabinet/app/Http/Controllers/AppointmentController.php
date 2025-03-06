<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json(Appointment::with('doctor')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $appointment = Appointment::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Appointment booked successfully', 'appointment' => $appointment], 201);
    }

    public function show($id)
    {
        return response()->json(Appointment::with('doctor')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return response()->json(['message' => 'Appointment updated', 'appointment' => $appointment]);
    }

    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return response()->json(['message' => 'Appointment deleted']);
    }
}
