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
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $q          = $request->input('q');
        $ctg        = (empty($request->input('ctg'))) ? null : $request->input('ctg');
        $sts        = (empty($request->input('sts'))) ? null : $request->input('sts');
        $kategori   = Category::where('status','p')->get();
        $q          = (empty($request->input('q'))) ? null : htmlentities($request->input('q'), ENT_QUOTES);
        $pengaduan  = Pengaduan::where('id_pengaduan','<>', 0);
        $fromDate   = (empty($request->input('fromDate'))) ? null : date('Y-m-d 00:00:00', strtotime($request->get('fromDate')));
        $toDate     = (empty($request->input('toDate'))) ? null : date('Y-m-d 23:59:59', strtotime($request->get('toDate')));
        $filter     = [$fromDate,$toDate];

        if (!empty($fromDate)) {
            $pengaduan  = $pengaduan->where('tgl_pengaduan', $fromDate);
        }

        if (!empty($fromDate && $toDate)) {
            $pengaduan  = $pengaduan->where('id_pengaduan','<>', null)
                                    ->orwhereBetween('tgl_pengaduan', [$fromDate,$toDate]);
        }

        if (!empty($ctg)) {
            $pengaduan  = $pengaduan->where('category_id',$ctg);
        }

        if (!empty($sts)) {
            $pengaduan  = $pengaduan->where('status',$sts);
        }

        // if (!empty($q)) {
        //     $pengaduan  = $pengaduan->where('judul_pengaduan','LIKE','%'.$q.'%')->orWhereHas('getCitizen', function($query) use ($q){
        //         return $query->where('nama','LIKE','%'.$q.'%')->Orwhere('email','LIKE','%'.$q.'%')->Orwhere('nik','LIKE','%'.$q.'%');
        //     });
        // }
        if (!empty($q)) {
            $pengaduan  = $pengaduan->where('judul_pengaduan','LIKE','%'.$q.'%')->orWhere('nik','LIKE','%'.$q.'%')->orWhereHas('getCitizen', function($query) use ($q){
                return $query->where('nama','LIKE','%'.$q.'%')->Orwhere('email','LIKE','%'.$q.'%')->Orwhere('nik','LIKE','%'.$q.'%');
            });
        }

        $pengaduan   = $pengaduan->paginate(10)->withQueryString();
        // $pengaduan= $pengaduan->get();

        return view('Pengaduan.index', compact('pengaduan','kategori'));
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
        $row                        = Pengaduan::where('id_pengaduan',$id)->first();
        // $row                        = Pengaduan::find($id);
        $data                       = array();
        $data['judul_pengaduan']    = $row->judul_pengaduan;
        $data['kategori']           = $row->category_id->getKategori->name;
        return view('Pengaduan.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function cetakReport(Request $request)
    {
        // dd($request->all());
        // $driTgl             = $request->input('driTgl');
        $driTgl             = date('Y-m-d 00:00:00', strtotime($request->get('driTgl')));
        // $hgTgl              = $request->input('hgTgl');
        $hgTgl              = date('Y-m-d 23:59:59', strtotime($request->get('hgTgl')));
        $pengaduan          = Pengaduan::whereBetween('tgl_pengaduan',[$driTgl,$hgTgl])->get();
        $data               = array();
        $data['pengaduan']  = $pengaduan;
        $data['driTgl']     = Carbon::parse($driTgl)->format('j F Y');
        $data['hgTgl']      = Carbon::parse($hgTgl)->format('j F Y');
        if (count($pengaduan) > 0) {
            view()->share('data',$data);
            $cetak              = PDF::loadview('Pengaduan.pdf');
            return $cetak->download('Laporan Dari Tanggal'.' '.$data['driTgl'].' '. 'Hingga Tanggal'.' '.$data['hgTgl'].'.'.'pdf');
        }

        return redirect()->back()->with('pdfail', 'gagal rek');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
    */
    public function action(Request $request)
    {
        // dd($request->all());
        switch ($request->aksi) {
            case 'selesai':
                // $cek_selesai    = Pengaduan::whereIn('id_pengaduan', $request->input(''));
                Pengaduan::whereIn('id_pengaduan', $request->input('id'))->update(['status'=>'selesai']);
                return redirect()->back()->with('success', 'Status Data Telah Selesai !!!');
                break;
            case 'proses':
                // dd($request->all());
                Pengaduan::whereIn('id_pengaduan', $request->input('id'))->update(['status'=>'proses']);
                return redirect()->back()->with('warning', 'Status Data Sudah di Proses !!!');
                break;
            case 'd':
                Pengaduan::whereIn('id_pengaduan', $request->input('id'))->delete();
                return redirect()->back()->with('danger', 'Data Sudah Di Hapus');
                break;
            default:
                return redirect()->back()->with('error', 'Error Connection !!!');
                break;
        }
    }
}
