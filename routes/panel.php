<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;
use App\Http\Livewire\Admin\Content\Contents;
use App\Http\Controllers\Panel\MangerController;
use App\Http\Controllers\Panel\ContentController;
use App\Http\Controllers\Panel\CategoryController;

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
Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('Admin.index');
    })->name('index');
    Route::get('/content',Contents::class)->name('content');
    Route::get('/setting',[HomeController::class , 'setting'])->name('setting');
    Route::post('/change-content',[ContentController::class , 'update'])->name('content.store');
    Route::resource('/manger', MangerController::class);
    Route::resource('/category', CategoryController::class);

});


