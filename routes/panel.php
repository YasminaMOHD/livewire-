<?php

use App\Http\Livewire\Website\About;
use App\Http\Livewire\Website\Index;
use App\Http\Livewire\User\Favorites;
use App\Http\Livewire\User\MyRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Website\OurWork;
use App\Http\Livewire\Website\Service;
use App\Http\Livewire\Admin\User\Users;
use App\Http\Livewire\Admin\Work\Works;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;
use App\Http\Livewire\Admin\Manger\Mangers;
use App\Http\Livewire\Admin\Content\Contents;
use App\Http\Livewire\Admin\Request\Requests;
use App\Http\Livewire\Admin\Employee\Employees;
use App\Http\Controllers\Panel\MangerController;
use App\Http\Livewire\Admin\Category\Categories;
use App\Http\Controllers\Panel\ContentController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Livewire\Admin\Authority\Authorities;

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
Route::get('/',Index::class)->name('index');
Route::get('/about-4Media',About::class)->name('about');
Route::get('/our-work',OurWork::class)->name('work');
Route::get('/services',Service::class)->name('service');
Route::get('/myFavorite',Favorites::class)->name('favorite');
Route::get('/myRequest',MyRequest::class)->name('myrequest');
Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/4mediapanel', function () {
        return view('Admin.index');
    })->name('index');
    Route::get('/authorities',Authorities::class)->name('authoritity');

    Route::get('/content',Contents::class)->name('content');
    Route::get('/works',Works::class)->name('work');
    Route::get('/mangers',Mangers::class)->name('manger');
    Route::get('/employees',Employees::class)->name('employee');
    Route::get('/categories',Categories::class)->name('category');
    Route::get('/user',Users::class)->name('user');
    Route::get('/requests',Requests::class)->name('request');
    Route::get('/setting',[HomeController::class , 'setting'])->name('setting');
    Route::post('/change-content',[ContentController::class , 'update'])->name('content.store');
    // Route::resource('/manger', MangerController::class);
    // Route::resource('/category', CategoryController::class);

});


