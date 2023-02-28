@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5 text-end">@if(empty($data['id'])) Buat Pengaduan @else Edit Pengaduan @endif</div>
                    <a href="{{$data['urlCancel']}}" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i></a>
                    <form action="{{$data['urlForm']}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="mb-3">
                          <label for="" class="form-label">Judul Pengaduan</label>
                          {{-- <input type="text" name="tgl_pengaduan" readonly value="{{old('tgl_pengaduan') ?? $data['tgl_pengaduan']}}" id="" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                          <input type="text" name="judul_pengaduan" id="" value="{{old('judul_pengaduan') ?? $data['judul_pengaduan']}}" class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Tanggal Pengaduan</label>
                          {{-- <input type="text" name="tgl_pengaduan" readonly value="{{old('tgl_pengaduan') ?? $data['tgl_pengaduan']}}" id="" class="form-control" placeholder="" aria-describedby="helpId"> --}}
                          <input type="datetime-local" name="tgl_pengaduan" id="" value="{{old('tgl_pengaduan') ?? $data['tgl_pengaduan']}}">
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Category Pengaduan</label>
                          <select name="category_id" id="" class="form-control select2 bg-light">
                            <option value="" selected> -- Pilih Category -- </option>
                            @foreach ($data['kategori'] as $k=>$v)
                                <option value="{{$v->id}}">{{$v->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Isi Laporan</label>
                          <textarea class="form-control" name="isi_laporan" id="" rows="30" cols="15">{{old('isi_laporan') ?? $data['isi_laporan']}}</textarea>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Dokumentasi</label>
                          <input type="file" class="form-control" name="foto" id="" placeholder="" aria-describedby="fileHelpId" multiple max="3">
                          {{-- @if (!empty($data['foto']))
                              <img src="" alt="" class="img-fluid">
                          @endif --}}
                        </div>
                        {{-- <div class="mb-3">
                          <label for="" class="form-label">Name</label>
                          <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                        </div> --}}
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection