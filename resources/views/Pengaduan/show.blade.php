@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h6><small>NIK Pembuat Aduan</small> : {{$pengaduan->nik}}</h6>
            <h6><small>NAMA Pembuat Aduan</small> : {{$pengaduan->getNikName->nama}}</h6>
            <h5><small>Kategori Aduan : {{$pengaduan->getKategori->name}}</small></h5>
            <h6><small>Judul Pengaduan</small> : {{$pengaduan->judul_pengaduan}}</h6>
            <h6><small>Tanggal Pengaduan</small> : {{$pengaduan->tgl_pengaduan}}</h6>
            <div class="d-block">
                <small>Isi Aduan</small>
                <p>{{$pengaduan->isi_laporan}}</p>
            </div>
            <div class="d-lg-block">
                <h6>Dokumentasi Pengaduan : </h6>
                <img src="{{asset('Dokumentasi/Pengaduan/'.$pengaduan->foto)}}" alt="" class="img-fluid" width="200px">
            </div>
        </div>
    </div>
@endsection