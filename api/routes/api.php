<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\SessionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/users', [UserController::class,'index']);

Route::prefix('/user')->group( function() {
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
}
);

Route::get('/technicians', [TechnicianController::class,'index']);

Route::prefix('/technician')->group( function() {
    Route::post('/store', [TechnicianController::class, 'store']);
    Route::get('/{id}', [TechnicianController::class, 'show']);
    Route::put('/{id}', [TechnicianController::class, 'update']);
    Route::delete('/{id}', [TechnicianController::class, 'destroy']);
}
);

Route::get('/managers', [ManagerController::class,'index']);

Route::prefix('/manager')->group( function() {
    Route::post('/store', [ManagerController::class, 'store']);
    Route::get('/{id}', [ManagerController::class, 'show']);
    Route::put('/{id}', [ManagerController::class, 'update']);
    Route::delete('/{id}', [ManagerController::class, 'destroy']);
}
);

Route::get('/calls', [CallsController::class,'index']);

Route::prefix('/call')->group( function() {
    Route::post('/store', [CallsController::class, 'store']);
    Route::get('/{id}', [CallsController::class, 'show']);
    Route::put('/{id}', [CallsController::class, 'update']);
    Route::delete('/{id}', [CallsController::class, 'destroy']);
}
);

Route::prefix('/session')->group( function() {
    Route::post('/store', [SessionController::class, 'store']);
    Route::get('/{id}', [CallsController::class, 'show']);
    Route::put('/{id}', [CallsController::class, 'update']);
    Route::delete('/{id}', [CallsController::class, 'destroy']);
}
);