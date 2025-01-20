<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            return response()->json([
                "status" => "Error",
                "message" => "No se encontraron estudiantes"
            ], 404);
        }

        return response()->json([
            "message" => "Estudiantes encontrados",
            "students" => $students
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'name' => "required|string|max:255",
            "email" => "required|email|string|max:255|unique:student",
            "phone" => "required|digits:10",
            "language" => "required|in:English,Spanish,French"
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => "Error",
                "message" => "Datos incorrectos",
                "errors" => $validator->errors()
            ];

            return response()->json($data, 400);
        }

        $student = Student::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "language" => $request->language
        ]);

        if (!$student) {
            return response()->json([
                "status" => "Error",
                "message" => "Error al crear el estudiante"
            ], 500);
        }

        $data = [
            "status" => "Success",
            "message" => "Estudiante creado",
            "student" => $student
        ];

        return response()->json($data, 201);

    }
}
