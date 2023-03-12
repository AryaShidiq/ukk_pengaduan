<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pengaduan;
use App\Models\Petugas;
use App\Models\Tanggapan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanggapan  = Tanggapan::all();

        return view('Tanggapan.index', compact('tanggapan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $kategori = Category::where('status', 'p')->get();
        $data                   =    array();
        $tanggal                = Carbon::now();
        $petugas                = Petugas::where('id_petugas', 1)->first();
        $data['id_pengaduan']   = Pengaduan::all();
        $data['id']             = '';
        $data['tgl_tanggapan']  = $tanggal->format('Y/M/D');
        $data['tgl_pengaduan']  = '';
        $data['tanggapan']      = '';
        $data['id_petugas']     = $petugas->id_petugas;
        $data['urlCancel']      = 'tanggapan';
        $data['urlForm']        = 'tanggapan/simpan';
        return view('Tanggapan.form', compact('data'));
    }

    public function fetchAjax($date)
    {
        $pengaduan  = Pengaduan::where('tgl_pengaduan',$date)->get();
        return response()->json($pengaduan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpanTanggapan(Request $request)
    {
        // dd($request->all());
        $id_pg      = $request->input('id_pengaduan');
        $date       = Carbon::now();
        $tanggapan  = $request->input('isi_laporan'); 
        $add_by     = auth()->guard('admin')->user()->id_petugas;
        
        try {
            DB::beginTransaction();
            $simpan                 = new Tanggapan();
            $simpan->id_pengaduan   = $id_pg;
            $simpan->tgl_tanggapan  = $date;
            $simpan->tanggapan      = $tanggapan;
            $simpan->id_petuhas     = $add_by;
            $simpan->save();
            Pengaduan::where('id_pengaduan', $id_pg)->update(['status'=>'selesai']);
            DB::commit();
            return redirect()->back()->with('tanggapan_done','ok'); 
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('tanggapan_fail', 'fail');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tanggapan  = Tanggapan::where('id_tanggapan',$id)->first();
        
        return view('Tanggapan.show', compact('tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tanggapan  $tanggapan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tanggapan $tanggapan)
    {
        //
    }
}
