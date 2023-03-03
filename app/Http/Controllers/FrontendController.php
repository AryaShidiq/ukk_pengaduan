<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function home(Request $request)
    {
        $data               = array();
        $tanggal            = Carbon::now();
        $kategori           = Category::where('status','p')->get();
        $data['category']   = $kategori;
        $data['tanggal']    = $tanggal;
        return view('welcome', compact('data'));
    }

    public function sendForm(Request $request)
    {
        // dd($request->all());
        $validator  = Validator::make($request->all(),[
            'tgl_pengaduan' => 'required',
            'category' => 'required',
            // 'foto*' => 'image|mimes:jpeg,png,jpg,webp',
            'isi_laporan' => 'required',
            'nik' => 'required',
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
            $simpan->status         = 'proses';
            if ($request->hasFile('foto')) {
                $file   = $request->file('foto');
                $name   = uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/Dokumentasi/Pengaduan', $name);
                $simpan->foto   = $name;
                $simpan->save();
            }
            $simpan->save();
            DB::commit();
            return redirect()->back()->with('sendFormSuccess', 'berhasil rek');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('sendFormFail', 'Gagal rek');
        }

    }
}
