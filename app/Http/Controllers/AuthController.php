<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    // use AuthenticatesUsers;

    public function form()
    {
        return view('Auth.login');
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email'=>'required|email',
    //         'password'=> 'required'
    //     ]);

    //     // if (Auth::guard('admin')->attempt($credentials)) {
    //     //     if (Auth::guard('admin')->user()->level == 'petugas') {
    //     //         // return redirect('/petugas');
    //     //         $request->session()->regenerate();
    //     //         return redirect('/');
    //     //         // return 'Petugas';
    //     //     } elseif(Auth::guard('admin')->user()->level == 'admin') {
    //     //         // return redirect('admin');
    //     //         $request->session()->regenerate();
    //     //         return redirect('/');
    //     //         // return 'Admin';
    //     //     }
    //     //     // dd(Auth::guard('admin')->user()->level);
    //     // } elseif(Auth::attempt($credentials)) {
    //     //     // return 'Masyarakat';
    //     //     return redirect('/');
    //     // }

    //     // if (Auth::guard('admin')->attempt($credentials)) {
    //     //     return redirect('/');
    //     // }
    //     // if (Auth::guard('masyarakat')->attempt($credentials)) {
    //     //     return redirect('/');
    //     // }

    //     if(Auth::guard('masyarakat')->attempt((['email' => $request->email, 'password' => $request->password]))) {
    //         return redirect('/');
    //     }elseif(Auth::guard('admin')->attempt((['email' => $request->email, 'password' => $request->password]))) {
    //         return redirect('/');
    //     }

    //     return redirect()->back();

    // }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=> 'required'
        ]);
        // $login  = Auth::guard('masyarakat')->attempt(['email' => $request-> email, 'password' => $request->password]);
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/masyarakat');
            // return 'Login OK';
        }

        return redirect()->back();

        // if(!Auth::guard('masyarakat')->validate($credentials)):
        //     return redirect()->to('login')
        //         ->withErrors(trans('auth.failed'));
        // endif;

        // $user = Auth::guard('masyarakat')->getProvider()->retrieveByCredentials($credentials);

        // Auth::guard('masyarakat')->login($user);

        // return $this->redirectUser($request, $user);


    }

    public function redirectUser(Request $request, $user)
    {
        return redirect('/masyarakat');
    }

    protected function guard($guard) {
        return Auth::guard($guard);
    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=> 'required'
        ]);

        if(Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        // if (self::guard('admin')->attempt($request->only('email', 'password'))) {
        //     self::guard('admin')->login(Auth::user(), true);
        //     return redirect('/');
        // }

        return redirect()->back();

    }

    public function logout()
    {
        // if (Auth::guard('masyarakat')->check()) {
            
        //     Auth::guard('masyarakat')->logout();
            
        //     request()->session()->invalidate();
        //     request()->session()->regenerateToken();
            
        //     return redirect('/login')->with('success','logout sebagai user');
        // } elseif(Auth::guard('admin')->check()) {
            
        //     Auth::guard('admin')->logout();
            
        //     request()->session()->invalidate();
        //     request()->session()->regenerateToken();

        //     return redirect('/login')->with('success', 'logout sebagai admin');
        // }
        Session::flush();
        
        Auth::logout();

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

        if ($validateData) {
            $validateData['password'] = bcrypt($validateData['password']);
    
            Masyarakat::create($validateData);
            $request->session()->flash('success', 'Berhasil Registrasi Silakan Login');
            return redirect('/login')->with('success','Registrasi Berhasil !!!');
        } else {
            return redirect()->back()->with('danger');
        }
        
    }
}
