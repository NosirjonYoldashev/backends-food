<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\IngredientInvoiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', static function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/auth/login', [AuthController::class,'login'])->name('auth.login');


Route::group(['middleware' => ['checkAuth']],static function () {

    Route::group(['prefix' => 'auth','as' => 'auth.'],static function (){
        Route::get('/me', [AuthController::class,'me']);
        Route::post('/logout', [AuthController::class,'logout']);
    });

    Route::group(['prefix' => 'users', 'as' => 'users.','controller' => UserController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{user}','update')->name('update');
        Route::delete('/{user}','destroy')->name('destroy');
    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.','controller' => RoleController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{role}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{role}','update')->name('update');
        Route::delete('/{role}','destroy')->name('destroy');
    });



    Route::group(['prefix' => 'ingredients', 'as' => 'ingredients.','controller' => IngredientController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{ingredient}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{ingredient}','update')->name('update');
        Route::delete('/{ingredient}','destroy')->name('destroy');
    });

    Route::group(['prefix' => 'measurements', 'as' => 'measurements.','controller' => MeasurementController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{measurement}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{measurement}','update')->name('update');
        Route::delete('/{measurement}','destroy')->name('destroy');
    });






    Route::group(['prefix' => 'ingredient_invoices', 'as' => 'ingredient_invoices.', 'controller' => IngredientInvoiceController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{ingredient_invoice}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::post('/{ingredient_invoice}/reject','reject')->name('reject');
        Route::post('/{ingredient_invoice}/confirm','confirm')->name('confirm');
        Route::match(['put','patch'],'/{ingredient_invoice}','update')->name('update');
    });

});




