<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Petugas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;
use DB;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function dashboard()
     {
        $data                       = array();
        $data['pengaduan']          = Pengaduan::count();
        $data['pengaduan_selesai']  = Pengaduan::where('status','selesai')->count();
        $data['petugas']            = Petugas::count();
        $data['user']               = Masyarakat::count();
        return view('dashboard', compact('data'));
     }

    public function index()
    {
        $petugas    = Petugas::paginate(10); 
        return view('Petugas.index', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data                       =    array();
        $data['id']                 = '';
        $data['nama_petugas']       = '';
        $data['email']              = '';
        $data['telp']               = '';
        $data['level']              = '';
        $data['password']           = '';
        $data['urlCancel']          = '/control/petugas';
        $data['urlForm']            = '/control/petugas/simpan';

        return view('Petugas.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        $id = $request->input('id');
        // dd($id);

        if (empty($id)) {
            $validator  = Validator::make($request->all(),[
                'nama_petugas' => 'required',
                'email'=> 'required|unique:petugas|email',
                'telp'=> 'required|digits_between:10,13',
                'level'=> 'required',
            ]);
        } else {
            $validator  = Validator::make($request->all(),[
                'nama_petugas' => 'required',
                'email'=> 'required|email',
                'telp'=> 'required|digits_between:10,13',
                'level'=> 'required',
            ]);
        }

        $cek_email  = Petugas::where('id_petugas','<>', $id)->where('email', $request->input('email'))->count();
        if ($cek_email > 0) {
            return redirect()->back()->with('error', 'Email Already Taken')->withInput();
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            $email          = $request->input('email');
            $nama_petugas   = $request->input('nama_petugas');
            $telp           = $request->input('telp');
            $level          = $request->input('level');
            if (empty($id)) {
                $add_by                 = auth()->guard('admin')->user()->id_petugas;
                $pass_ori               = '12345678';
                $simpan                 = new Petugas();
                $simpan->nama_petugas   = $nama_petugas;
                $simpan->email          = $email;
                $simpan->telp           = $telp;
                $simpan->level          = $level;
                $simpan->add_by         = $add_by;
                $simpan->password       = Hash::make($pass_ori);
                $simpan->save();
            } else {
                $edit_by                = auth()->guard('admin')->user()->id_petugas;
                $simpan                 = Petugas::find($id);
                $simpan->nama_petugas   = $nama_petugas;
                $simpan->email          = $email;
                $simpan->telp           = $telp;
                $simpan->level          = $level;
                $simpan->edit_by        = $edit_by;
                $simpan->save();
            }
            DB::commit();
            return redirect('/control/petugas')->with('success','Data Berhasil Di Simpan');
        } catch (Exception $e) {
            DB::rollback();
            return redirect('/control/petugas')->with('error','Error Connection');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $petugas,$id)
    {
        $data                   = array();

        $row                    = Petugas::where('id_petugas', $id)->first();
        // $row                    = Petugas::find($id);
        $data['id']             = $row->id_petugas;
        $data['nama_petugas']   = $row->nama_petugas;
        $data['email']          = $row->email;
        $data['telp']           = $row->telp;
        $data['level']          = $row->level;
        $data['urlCancel']      = '/control/petugas';
        $data['urlForm']        = '/control/petugas/simpan';

        return view('Petugas.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $petugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        switch ($request->aksi) {
            case 'r':
                $pass_ori   = '12345678'; 
                $pass       = Hash::make($pass_ori);
                $id         = $request->input('id');
                $edit_by    = auth()->guard('admin')->user()->id_petugas;
                $dataSimpan = Petugas::find($id)->first();
                $dataSimpan->password = $pass;
                $dataSimpan->edit_by = $edit_by;
                $dataSimpan->save();
                return redirect()->back()->with('success','Akun sudah di Reset !!!');
                break;
            case 'd':
                Petugas::whereIn('id_petugas', $request->input('id'))->delete();
                return redirect()->back()->with('danger','Akun sudah di Delete !!!');
                break;
            default:
                return redirect()->back()->with('error', 'Error Connection !!!');
                break;
        }
    
    }
}
