<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("/users/{id}", [PagesController::class, 'getUsers']);
Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('cars', CarsController::class)->middleware(['auth','is_admin']);
Route::resource('cars', CarsController::class);

Route::patch('/cars/image/{car}/upload', [CarsController::class, 'upload_image'])->name('cars.image.upload');

Route::post('/cars/model/{car}', [PagesController::class, 'add_model'])->name('cars.add_model');

Route::get('/contact', [PagesController::class, 'show_contact'])->name('show.contact');
Route::post('/contact',[PagesController::class, 'send_message'])->name('send.message');