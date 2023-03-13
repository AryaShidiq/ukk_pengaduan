<?php

namespace App\Http\Controllers;

use App\Models\Masyarakat;
use Illuminate\Http\Request;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q          = (empty($request->input('q'))) ? null : htmlentities($request->input('q'), ENT_QUOTES);
        $masyarakat = Masyarakat::where('id','<>',null);
        if (!empty($q)) {
            $masyarakat = $masyarakat->where('nama','LIKE','%'.$q.'%')->Orwhere('email','LIKE','%'.$q.'%')->Orwhere('nik','LIKE','%'.$q.'%');
        }
        $masyarakat = $masyarakat->paginate(10);
        return view('Masyarakat.index', compact('masyarakat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function show(Masyarakat $masyarakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit(Masyarakat $masyarakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masyarakat $masyarakat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        switch ($request->aksi) {
            case 'd':
                Masyarakat::wherein('id',$request->input('id'));
                return redirect()->back()->with('successDelete','Data Telah Dihapus !!!');
                break;
            
            default:
                return redirect()->back()->with('error','Error Connection !!!');
                break;
        }
    }
}
