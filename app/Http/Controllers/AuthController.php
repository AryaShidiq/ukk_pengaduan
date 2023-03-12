<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:masyarakat')->except('logout');
    }

    // use AuthenticatesUsers;

    public function form()
    {
        return view('Auth.login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            // 'nik'=> 'required',
            'email'=>'required|email',
            'password'=> 'required'
        ]);
        // $login  = Auth::guard('masyarakat')->attempt(['email' => $request-> email, 'password' => $request->password]);
        if (Auth::guard('masyarakat')->attempt($credentials)) {

            return redirect('/')->with('loginDone','ok');
            
        }

        return redirect()->back()->with('loginFail','ok')->withInput($request->only('email', 'nik'));

    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=> 'required'
        ]);

        if(Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/control');
        }

        // if (self::guard('admin')->attempt($request->only('email', 'password'))) {
        //     self::guard('admin')->login(Auth::user(), true);
        //     return redirect('/');
        // }

        return redirect()->back();

    }

    public function logout()
    {
        if (Auth::guard('masyarakat')->check()) {
            
            Auth::guard('masyarakat')->logout();
            
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            
            return redirect('/')->with('success','logout sebagai user');
        } elseif(Auth::guard('admin')->check()) {
            
            Auth::guard('admin')->logout();
            
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/login')->with('success', 'logout sebagai admin');
        }
        // Auth::logout();

        // request()->session()->invalidate();
        // request()->session()->regenerateToken();


        return redirect('login');

    }
    public function formRegis()
    {
        return view('Auth.register');
    }

    public function postRegis(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'nik'=> 'required|numeric|min:16|unique:masyarakats',
            'nama' => 'required|max:255',
            'email' => 'required|email|unique:masyarakats',
            'password' => 'required|min:6|max:255',
            'telp'=> 'required|numeric|digits_between:10,13',
        ],[
            'nik.unique' => 'NIK Telah Digunakan !',
            'email.unique' => 'Email Telah Digunakan !',
            'telp'=> 'Isi No Telfon Hanya Dengan Angka!',
        ]);
        // if($validation->fails()) {
        //     return redirect()->back()->withErrors($validator) ->withInput();
        //   }
        if ($validateData) {
            $validateData['password'] = Hash::make($validateData['password']);
            // dd($validateData);
            Masyarakat::create($validateData);
            $request->session()->flash('success', 'Berhasil Registrasi Silakan Login');
            return redirect('/')->with('success','Registrasi Berhasil !!!');
        } else {
            // return redirect()->back()->withInput()->with('regist fail', 'gagal lurr');
            return redirect()->back()->with('registFail', 'gagal lurr');
            // return 'Login GAgal';
        }
        // Masyarakat::create($request->all());
        // return redirect('/');
        
    }
}
