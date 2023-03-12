@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Judul Pengaduan</label>
                        <h6>{{$data['judul_pengaduan']}}</h6>
                    </div>
                    <div class="mb-3">                                                                                                                                                              -
                        <label for="" class="form-label">Kategori Pengaduan</label>
                        <h6>{{$data['kategori']}}</h6>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Judul Pengaduan</label>
                        {{-- <h6>{{$data['']}}</h6> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection