<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'auth:admin'],function(){
    Route::get('/petugas', function () {
        return view('Petugas.index');
    });
    Route::get('/admin', function () {
        return view('Administrator.index');
    });
    
});

Route::get('/masyarakat', function () {
    return view('Masyarakat.index');
})->middleware('auth:masyarakat');

// Route::get('/masyarakat', function () {
//     return view('Masyarakat.index');
// })->middleware('auth:admin,masyarakat');
// Route::get('masyarakat', function(){
//     return view('Masyarakat.index');
// });
Route::get('login', [AuthController::class, 'form'])->name('login');
Route::post('postlogin-user', [AuthController::class, 'loginUser'])->name('post-log-user');
Route::post('postlogin-admin', [AuthController::class, 'loginAdmin'])->name('post-log-admin');
Route::get('register', [AuthController::class, 'formRegis']);
Route::post('register/post', [AuthController::class, 'postRegis']);
Route::get('logout', [AuthController::class, 'logout']);
Route::group(['prefix'=>'pengaduan'],function () {
    // Route::get('/orders/{id}', 'show');
    Route::get('/', [PengaduanController::class ,'index'])->middleware('auth:web');
    Route::get('create', [PengaduanController::class ,'create']);
    Route::get('/edit', [PengaduanController::class ,'edit']);
    // Route::post('/orders', 'store');
});
Route::group(['prefix'=> 'category'],function () {
    Route::get('/', [CategoryController::class,'index']);
    Route::get('/create', [CategoryController::class ,'create']);
    Route::get('/edit/{id}', [CategoryController::class ,'edit']);
    Route::post('/simpan', [CategoryController::class ,'simpanCategory']);
    Route::match(['get', 'post'], '/action', [CategoryController::class ,'action']);
    // Route::get('/{id}', 'show');
    // Route::post('/orders', 'store');
});