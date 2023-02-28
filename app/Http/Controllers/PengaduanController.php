<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduan = Pengaduan::all();

        return view('Pengaduan.index', compact('pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data                   = array();
        $tanggal                = Carbon::now();
        $data['id']             = '';
        $data['nik']            = '';
        $data['judul_pengaduan']= '';
        // $data['tgl_pengaduan']  = $tanggal->format('j F, Y');
        $data['tgl_pengaduan']  = $tanggal->format('Y/M/D');
        $data['kategori']       = Category::where('status','p')->get();
        $data['isi_laporan']    = '';
        $data['foto']           = '';
        $data['status']         = '';
        $data['urlCancel']      = '/masyarakat';
        $data['urlForm']        = '/pengaduan/simpan';

        return view('Masyarakat.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpanPengaduan(Request $request)
    {
        // dd($request->all());
        $id = $request->input('id');
        if (empty($id)) {
            $validator  = Validator::make($request->all(),[
                // 'tgl_pengaduan' => 'required',
                'category_id' => 'required',
                'foto*' => 'image|mimes:jpeg,png,jpg,webp',
                'isi_laporan' => 'required',
            ]);
        } else {
            $validator  = Validator::make($request->all(),[
                // 'tgl_pengaduan' => 'required',
                'category_id' => 'required',
                'foto*' => 'image|mimes:jpeg,png,jpg,webp',
                'isi_laporan' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()()->withErrors($validator)->withInput();
        }
        // $dataImage  = [];
        // if ($request->hasFile('foto')) {
        //     foreach ($request->file('foto') as $file) {
        //         $name = uniqid().'.'.$file->getClientOriginalExtension();
        //         $file->move(public_path().'/Dokumentasi/Pengaduan', $name);
        //         $dataImage[] = $name;
        //     }
        // }
        // $file   = new Pengaduan();
        // $file->foto = json_encode($dataImage);

        try {
            DB::beginTransaction();
            $id             = $request->input('id');
            // $tgl_pengaduan  = $request->input('tgl_pengaduan');
            $tgl_pengaduan  = Carbon::now();
            $judul_pengaduan= $request->input('judul_pengaduan');
            $category_id    = $request->input('category_id');
            // $mas            = Masyarakat::inRandomOrder()->take(1)->get();
            $mas            = Masyarakat::where('id', 1)->first();
            $nik            = $mas->nik;
            // $nik            = 2498246730198736;
            $isi_laporan    = $request->input('isi_laporan');
            // $foto           = json_encode($dataImage);
            // $foto           = $file;

            if (empty($id)) {
                $simpan                 = new Pengaduan();
                $simpan->judul_pengaduan= $judul_pengaduan;
                $simpan->tgl_pengaduan  = $tgl_pengaduan;
                $simpan->nik            = $nik;
                $simpan->category_id    = $category_id;
                $simpan->isi_laporan    = $isi_laporan;
                $simpan->status         = 'proses';
                if ($request->hasFile('foto')) {
                    $file   = $request->file('foto');
                    $name   = uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path().'/Dokumentasi/Pengaduan', $name);
                    $simpan->foto   = $name;
                    $simpan->save();
                }
                $simpan->save();
                
            } else {
                $simpan                 = Pengaduan::find($id);
                $simpan->judul_pengaduan= $judul_pengaduan;
                $oldImg                 = $simpan->foto;
                if (!empty($oldImg)) {
                    foreach (json_decode($oldImg) as $v) {
                        File::delete(public_path('Dokumentasi/Pengaduan/'.$v));
                    }
                }
                $simpan->tgl_pengaduan  = $tgl_pengaduan;
                $simpan->nik            = $nik;
                $simpan->category_id    = $category_id;
                $simpan->isi_laporan    = $isi_laporan;
                $simpan->foto           = $foto;
                $simpan->save();
            }
            DB::commit();
            return redirect('/pengaduan');
            
        } catch (Exception $e) {
            DB::rollBack();
            if (isset($dataImage)) {
                File::delete(public_path('Dokumentasi/Pengaduan/'.$dataImage));            }
            return redirect('/pengaduan');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $pengaduan  = Pengaduan::where('id_pengaduan', $id)->first();
        return view('Pengaduan.show', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        return view('Pengaduan.form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}
