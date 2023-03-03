@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="badge badge-danger">Data Petugas</h1>
                    <h6><span class="badge badge-primary">Nama Petugas</span> : {{$tanggapan->getPetugas->nama_petugas}}</h6>
                    <h6><span class="badge badge-primary">Email Petugas</span> : {{$tanggapan->getPetugas->email}}</h6>
                    <h6><span class="badge badge-primary">No Telfon Petugas</span> : {{$tanggapan->getPetugas->telp}}</h6>
                    <h6><span class="badge badge-primary">Role Petugas</span> : {{$tanggapan->getPetugas->level}}</h6>
                </div>
                <div class="col-md-6">
                    <h6><span class="badge badge-primary">Judul Aduan</span> : {{$tanggapan->getPengaduan->judul_pengaduan}}</h6>
                    <h6><span class="badge badge-primary">Tanggal Pembuatan Aduan</span> : {{$tanggapan->getPengaduan->tgl_pengaduan}}</h6>
                    <h6><span class="badge badge-primary">Tanggal Tanggapan</span> : {{$tanggapan->tgl_tanggapan}}</h6>
                    <div class="d-block">
                        <span class="badge badge-warning">Tanggapan</span>
                        <p>{{$tanggapan->tanggapan}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection