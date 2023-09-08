<?php

use App\Services\Kangaroo\Controllers\KangarooController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('list');
});

Route::prefix('kangaroo')->group(function () {
    Route::view('list', 'list');
    Route::view('create', 'form');
    Route::view('edit/{iId}', 'form');
});

Route::name('\App\Services\Kangaroo\Controllers')->prefix('/api/kangaroo')->group(function() {
    Route::get('/', [KangarooController::class, 'getAllKangaroo']);
    Route::post('/', [KangarooController::class, 'createKangaroo']);
    Route::put('/', [KangarooController::class, 'updateKangaroo']);
    Route::get('/duplicate', [KangarooController::class, 'checkDuplicateName']);
    Route::get('/{iId}', [KangarooController::class, 'getKangarooById']);
});
