<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Matakuliah_MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::patch('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/{id}', [DosenController::class, 'destroy']);

Route::post('/dosen', [DosenController::class, 'store']);
Route::put('/dosen/{id}', [DosenController::class, 'update']);
Route::patch('/dosen/{id}', [DosenController::class, 'update']);
Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);

Route::post('/dosen-pembimbing', [DosenPembimbingController::class, 'store']);
Route::put('/dosen-pembimbing/{id}', [DosenPembimbingController::class, 'update']);
Route::delete('/dosen-pembimbing/{id}', [DosenPembimbingController::class, 'destroy']);

Route::post('/matakuliah', [MatakuliahController::class, 'store']);
Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update']);
Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy']);
Route::get('/matakuliah/{id}', [MatakuliahController::class, 'show']);

Route::post('/matakuliah-mahasiswa', [Matakuliah_MahasiswaController::class, 'store']);
Route::put('/matakuliah-mahasiswa/{id}', [Matakuliah_MahasiswaController::class, 'update']);
Route::delete('/matakuliah-mahasiswa/{id}', [Matakuliah_MahasiswaController::class, 'destroy']);

Route::post('/test', function (Request $request) {
    $nama = $request->input('nama');
    $umur = $request->input('umur');
    $response = [
        'nama' => $nama,
        'umur' => $umur
    ];

    return response()->json($response, 200);
});