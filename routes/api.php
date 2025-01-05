<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IngredientInvoiceController;
use App\Http\Controllers\IngredientInvoiceItemController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Requests\IngredientInvoiceItemRequest;
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

    Route::group(['prefix' => 'suppliers', 'as' => 'suppliers.','controller' => SupplierController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{supplier}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{supplier}','update')->name('update');
        Route::delete('/{supplier}','destroy')->name('destroy');
        Route::put('/{supplier}/toggleStatus','toggleStatus')->name('toggleStatus');
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

    Route::group(['prefix' => 'ingredient_invoices', 'as' => 'ingredient_invoices.','controller' => IngredientInvoiceController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{ingredient_invoices}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{ingredient_invoices}','update')->name('update');
        Route::delete('/{ingredient_invoices}','destroy')->name('destroy');
    });

    Route::group(['prefix' => 'stock_movements', 'as' => 'stock_movements.','controller' => StockMovementController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{stock_movement}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{stock_movement}','update')->name('update');
        Route::delete('/{stock_movement}','destroy')->name('destroy');
    });

    Route::group(['prefix' => 'stocks', 'as' => 'stocks.','controller' => StockController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{stock}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{stock}','update')->name('update');
        Route::delete('/{stock}','destroy')->name('destroy');
    });

    Route::group(['prefix' => 'ingredient_invoice_items', 'as' => 'ingredient_invoice_items.','controller' => IngredientInvoiceItemController::class],static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{ingredient_invoice_items}', 'show')->name('show');
        Route::post('/','store')->name('store');
        Route::match(['put','patch'],'/{ingredient_invoice_items}','update')->name('update');
        Route::delete('/{ingredient_invoice_items}','destroy')->name('destroy');
    });

});




