<?php

use App\Http\Controllers\BlogController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(["middleware" => ["auth"]], function(){
    Route::resource("blogs", BlogController::class)->except("show");
Route::put("blogs/{blog}/complete", [BlogController::class, "complete"])
->name("blogs.complete")
->middleware("our:admin");
});


require __DIR__.'/auth.php';
