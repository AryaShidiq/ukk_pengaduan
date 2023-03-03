@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h1>Data Diri Pemberi Aduan</h1>
                    <h6><span class="badge badge-primary">NIK Pembuat Aduan</span> : <span class="badge badge-secondary text-dark"> {{$pengaduan->nik}}</span></h6>
                    <h6><span class="badge badge-primary">Nama Pembuat Aduan</span> : <span class="badge badge-secondary text-dark"> {{$pengaduan->getCitizen->nama}}</span></h6>
                    <h6><span class="badge badge-primary">Email Pembuat Aduan</span> : <span class="badge badge-secondary text-dark"> {{$pengaduan->getCitizen->email}}</span></h6>
                    <h6><span class="badge badge-primary">No Telfon Pembuat Aduan</span> : <span class="badge badge-secondary text-dark"> {{$pengaduan->getCitizen->telp}}</span></h6>
                </div>
                <div class="col-md-6">
                    <h1>Detail Aduan</h1>
                    <h5><small>Kategori Aduan : {{$pengaduan->getKategori->name}}</small></h5>
                    <h6><span class="badge badge-primary">Judul Pengaduan</span> : {{$pengaduan->judul_pengaduan}}</h6>
                    <h6><span class="badge badge-primary">Tanggal Pengaduan</span> : {{$pengaduan->tgl_pengaduan}}</h6>
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
        </div>
    </div>
@endsection