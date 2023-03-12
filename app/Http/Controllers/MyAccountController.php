<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index()
    {
        $user                   = Petugas::where('id_petugas', auth()->guard()->user()->id_petugas)->first();
        $data                   = array();
        $data['nama_petugas']   = $user->nama_petugas;
        $data['email']          = $user->email;
        $data['level']          = $user->level;
        $data['telp']           = $user->telp;
        $data['add_by']         = $user->add_by;
        $data['edit_by']        = $user->edit_by;

        return view('Administrator.myaccount', compact('data'));
    }
}
