<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Routing\RouteGroup;
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

// Route::get('/test', function () {
//     for($i=1; $i<10; $i++) {
//         $total = $total + $i;
//     }
//     return $total;
//     // $user = Auth::guard('masyarakat')->user();
//     // return view('welcome');
// });
Route::group(['middleware'=>'auth:admin','prefix'=>'control'] ,function () {
    Route::get('/', [PetugasController::class, 'dashboard']);
    Route::get('/myaccount', [MyAccountController::class, 'index']);
    Route::prefix('petugas')->group(function () {
        Route::get('/', [PetugasController::class, 'index']);
        Route::get('/add', [PetugasController::class, 'add']);
        Route::get('/edit/{id}', [PetugasController::class, 'edit']);
        Route::post('/simpan', [PetugasController::class, 'simpan']);
        Route::match(['get', 'post'], '/action', [PetugasController::class ,'action']);
        Route::get('/admin', function () {
            return view('Administrator.index');
        });
    });
});
// Route::group(['middleware' => ['auth:admin','RoleAccess:admin']],function(){
//     Route::get('/petugas', [PetugasController::class, 'index']);
//     Route::get('/petugas/add', [PetugasController::class, 'add']);
//     Route::get('/petugas/edit/{id}', [PetugasController::class, 'edit']);
//     Route::post('/petugas/simpan', [PetugasController::class, 'simpan']);
//     Route::match(['get', 'post'], 'petugas/action', [PetugasController::class ,'action']);
//     Route::get('/admin', function () {
//         return view('Administrator.index');
//     });
    
// });
Route::group(['middleware' => ['auth:admin'], 'prefix'=>'admin'],function(){
    Route::get('/petugas/edit/{id}', [MyAccountController::class, 'edit']);
    Route::post('/petugas/simpan', [MyAccountController::class, 'simpan']);
    Route::match(['get', 'post'], 'petugas/action', [MyAccountController::class ,'action']);
    Route::get('/admin', function () {
        return view('Administrator.index');
    });
    
});
// Frontend
Route::get('/', [FrontendController::class, 'home']);
Route::post('/kirim-pengaduan', [FrontendController::class, 'sendForm'])->middleware('auth:masyarakat');
Route::get('/myaccount', [FrontendController::class,'myaccount'])->middleware('auth:masyarakat');

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
    Route::match(['get', 'post'], '/action', [PengaduanController::class ,'action']);
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
    Route::get('/create/pengaduan-{{id_pengaduan}}', [TanggapanController::class, 'create']);
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
