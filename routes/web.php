<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MasyarakatController;
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

// Route::get('/', function () {
//     // $user = Auth::guard('masyarakat')->user();
//     return view('welcome');
// });
Route::group(['middleware' => ['auth:admin']],function(){
    Route::get('/petugas', function () {
        return view('Petugas.index');
    });
    Route::get('/admin', function () {
        return view('Administrator.index');
    });
    
});
// Frontend
Route::get('/', [FrontendController::class, 'home']);
Route::post('/kirim-pengaduan', [FrontendController::class, 'sendForm']);

// Auth
Route::get('login', [AuthController::class, 'form'])->name('login');
Route::post('postlogin-user', [AuthController::class, 'loginUser'])->name('post-log-user');
Route::post('postlogin-admin', [AuthController::class, 'loginAdmin'])->name('post-log-admin');
Route::get('register', [AuthController::class, 'formRegis']);
Route::post('register/post', [AuthController::class, 'postRegis'])->name('post-regis');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['prefix'=>'pengaduan'],function () {
    // Route::get('/orders/{id}', 'show');
    // Route::get('/', [PengaduanController::class ,'index'])->middleware('auth:web');
    Route::get('/', [PengaduanController::class ,'index']);
    Route::get('create', [PengaduanController::class ,'create']);
    Route::get('/edit/{id}', [PengaduanController::class ,'edit']);
    Route::get('/detail/{id}', [PengaduanController::class, 'show']);
    Route::post('/simpan', [PengaduanController::class,'simpanPengaduan']);
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
Auth::routes();
Route::group(['prefix' => 'tanggapan', 'middleware' => 'auth:admin'], function() {
    Route::get('/', [TanggapanController::class, 'index']);
    Route::get('/ajax/{date}', [TanggapanController::class, 'fetchAjax']);
    Route::get('/create', [TanggapanController::class, 'create']);
    Route::get('/edit/{id}', [TanggapanController::class, 'edit']);
    Route::post('/simpan', [TanggapanController::class, 'simpanTanggapan']);
    Route::get('/detail/{id}', [TanggapanController::class, 'show']);
    Route::match(['get', 'post'], '/action', [TanggapanController::class, 'action']);
});
Route::prefix('masyarakat')->group(function () {
    Route::get('/', [MasyarakatController::class, 'index']);
});
// Route::controller(MasyarakatController::class)->group(['prefix'=> 'masyarakat'],function () {
//     Route::get('/', 'index');
//     Route::post('/orders', 'store');
// });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
