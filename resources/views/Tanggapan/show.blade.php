@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h6><small>Judul Aduan</small> : {{$tanggapan->getPengaduan->judul_pengaduan}}</h6>
            <h6><small>Tanggal Tanggapan</small> : {{$tanggapan->tgl_tanggapan}}</h6>
            <h5><small>Nama Petugas : {{$tanggapan->getPetugas->nama_petugas}}</small></h5>
            <div class="d-block">
                <small>Tanggapan</small>
                <p>{{$tanggapan->tanggapan}}</p>
            </div>
        </div>
    </div>
@endsection