<?php

use App\Http\Controllers\studentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/students", [studentController::class, 'index']);

Route::get("/students/{id}", function ($id) {
    return "Obteniendo estudiante con id: $id";
});

Route::post("/students", [studentController::class, 'store']);

Route::put("/students/{id}", function ($id) {
    return "Actualizando estudiante con id: $id";
});

Route::delete("/students/{id}", function ($id) {
    return "Eliminando estudiante con id: $id";
});

