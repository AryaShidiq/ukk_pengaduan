<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use session;

class FrontendController extends Controller
{
    public function home(Request $request)
    {
        $data                   = array();
        $tanggal                = Carbon::now();
        $kategori               = Category::where('status','p')->get();
        $data['category']       = $kategori;
        $data['tanggal']        = $tanggal;
        $data['total_aduan']    = Pengaduan::count();
        $data['aduan_clear']    = Pengaduan::where('status','selesai')->count();
        $data['total_user']     = Masyarakat::count();
        // return redirect('/')->with(['data',$data])->session()->flash('loginDone', 'This is a message!');
        return view('welcome', compact('data'));
    }

    public function sendForm(Request $request)
    {
        // dd($request->all());
        $validator  = Validator::make($request->all(),[
            'tgl_pengaduan' => 'required',
            'category' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,webp',
            'isi_laporan' => 'required',
            'judul_pengaduan' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            DB::beginTransaction();
            $tgl_pengaduan      = $request->input('tgl_pengaduan');
            $judul_pengaduan    = $request->input('judul_pengaduan');
            $isi_laporan        = $request->input('isi_laporan');
            $nik                = auth()->guard('masyarakat')->user()->nik;
            $category           = $request->input('category');
            $foto               = $request->input('foto');

            $simpan                 = new Pengaduan();
            $simpan->tgl_pengaduan  = $tgl_pengaduan;
            $simpan->judul_pengaduan= $judul_pengaduan;
            $simpan->isi_laporan    = $isi_laporan;
            $simpan->nik            = $nik;
            $simpan->category_id    = $category;
            $simpan->status         = '0';
            if ($request->hasFile('foto')) {
                $file   = $request->file('foto');
                $name   = uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/Dokumentasi/Pengaduan', $name);
                $simpan->foto   = $name;
                $simpan->save();
            }
            // dd($simpan);
            $simpan->save();
            DB::commit();
            return redirect()->back()->with('aduanDone', 'berhasil rek');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('sendFormFail', 'Gagal rek');
        }

    }

    public function laporanku()
    {
        $user   = Masyarakat::where('nik',auth()->guard('masyarakat')->user()->nik)->first();
        // $pengaduan = Pengaduan::where('nik',auth()->guard('masyarakat')->user()->nik)->paginate(10);
        $pengaduan          = Pengaduan::where('nik',auth()->guard('masyarakat')->user()->nik)->paginate(10);
        $data               = array();
        $tanggal            = Carbon::now();
        $kategori           = Category::where('status','p')->get();
        $data['category']   = $kategori;
        $data['tanggal']    = $tanggal;
        return view('frontend.laporanku', compact('pengaduan', 'user','data'));
    }
}
