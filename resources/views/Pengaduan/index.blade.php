@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="page-header">
                <h4 class="page-title">Data Pengaduan</h4>
                <nav class="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pengaduan</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <form action="GET" action="{{URL::current()}}">
                            <div class="btn-group">
                                <a href="javascript:void()" class="btn btn-sm text-light btn-primary" id="aksi"><i class="mdi mdi-plus"></i> Add</a>
                                <a href="javascript:void()" class="btn btn-sm text-light btn-success" id="aksi_selesai"><i class="mdi mdi-check"></i> Selesai</a>
                                <a href="javascript:void()" class="btn btn-sm text-light btn-warning" id="aksi_proses"><i class="mdi mdi-alert-circle"></i> Proses</a>
                                <a href="javascript:void()" class="btn btn-sm text-light btn-danger"  id="aksi"><i class="mdi mdi-delete"></i> Delete</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="{{URL::current()}}">
                        <input type="text" class="form-control" placeholder="Cari nama, nik atau email pelapor, Judul Pengaduan" name="q" value="{{old('q')}}">
                        <button class="btn btn-primary"><span class="mdi mdi-send"></span></button>
                      </form>
                </div>
                <div class="col-lg-12">
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="{{URL::current()}}">
                        {{-- @csrf --}}
                        <div class="col-md-10 d-flex justify-content-around">
                            <div class="form-group">
                                <select name="sts" id="" class="js-example-basic-single">
                                    <option value="" selected>-- All Status --</option>
                                    <option value="0" @if(Request::get('sts') == '0') selected @endif>Pending</option>
                                    <option value="proses" @if(Request::get('sts') == 'proses') selected @endif>Proses</option>
                                    <option value="selesai" @if(Request::get('sts') == 'selesai') selected @endif >Selesai</option>
                                    {{-- @foreach ($kategori as $k=>$v)
                                    <option @if(Request::get('sts') == $v->id ) selected @endif value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="ctg" id="" class="js-example-basic-single">
                                    <option value="" selected>-- All Category ---</option>
                                    @foreach ($kategori as $k=>$v)
                                    <option @if(Request::get('ctg') == $v->id ) selected @endif value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-block">
                                {{-- <label for="">Dari Tanggal</label> --}}
                                <input type="date" name="fromDate" id="" value="{{old('fromDate')}}">
                            </div>
                            <div class="form-group d-block">
                                {{-- <label for="">Hingga Tanggal</label> --}}
                                <input type="date" name="toDate" id="" value="{{old('toDate')}}">
                            </div>
                        </div>
                        <div class="mb-3 d-block">
                        </div>
                        <button class="btn btn-primary"><span class="mdi mdi-send"></span></button>
                    </form>
                </div>
                <div class="col-lg-12">
                    <form action="{{url('pengaduan/action')}}" id="a" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" id="aksi" value="">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <div class="form-check form-check-muted m-0">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="selectAll">
                                              </label>
                                            </div>
                                          </th>
                                        <th>NO</th>
                                        <th>Tanggal Pengaduan</th>
                                        <th>Kategori Pengaduan</th>
                                        <th>Judul Pengaduan</th>
                                        <th>NIK Pelapor</th>
                                        <th>Nama Pelapor</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($pengaduan) > 0)
                                    @foreach ($pengaduan as $k=>$v)
                                        <tr>
                                            <th class="text-center">
                                                <div class="form-check form-check-muted m-0">
                                                    <label class="form-check-label">
                                                      <input type="checkbox" class="form-check-input" name="id_action[]" id="{{$v->id_pengaduan}}" value="{{$v->id_pengaduan}}">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>{{$k+1}}</th>
                                            <th>{{$v->tgl_pengaduan}}</th>
                                            <th>{{$v->getKategori->name}}</th>
                                            <th>{{$v->judul_pengaduan}}</th>
                                            <th>{{$v->nik}}</th>
                                            <th>{{$v->getCitizen->nama}}</th>
                                            <th>
                                                @if ($v->status == 'proses')
                                                <label for="" class="badge badge-warning">Proses</label>
                                                @elseif($v->status == 'selesai')
                                                <label for="" class="badge badge-success">Selesai</label>
                                                @else
                                                <label for="" class="badge badge-danger">Pending</label>
                                                @endif
                                            </th>
                                            <th>
                                                <a href="{{url('pengaduan/edit/'.$v->id_pengaduan)}}" class="btn btn-warning text-light btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
                                                <a href="{{url('pengaduan/detail/'.$v->id_pengaduan)}}" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>
                                                {{-- <a href="{{url('tanggapan/create/pengaduan-'.$v->id_pengaduan)}}" class="btn btn-dark btn-sm" title="Buat Tanggapan"><i class="mdi mdi-book-plus"></i></a> --}}
                                                @if ($v->status == 'proses')
                                                <a type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$k+1}}" title="Buat Tanggapan"><i class="mdi mdi-book-plus"></i></a>
                                                @endif
                                            </th>
                                        </tr>
                                        @if ($v->status == 'proses')
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal-{{$k+1}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{url('tanggapan/simpan')}}" method="post" id="tanggapan-{{$k}}">
                                                            @csrf
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <input type="hidden" name="id_pengaduan" value="{{$v->id_pengaduan}}">
                                                                    {{-- <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                        <label for="" class="form-label">Name</label>
                                                                        <input type="text"
                                                                            class="form-control" name="" id="" aria-describedby="helpId" placeholder="" value="{{$v->judul_pengaduan}}">
                                                                        </div> --}}
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Tanggapan</label>
                                                                            <textarea class="form-control" name="isi_tanggapan" id="" rows="8"></textarea>
                                                                        </div>
                                                                        <div class="d-flex">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary float-right" form="tanggapan-{{$k}}">Save changes</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    {{-- <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary float-right" form="tanggapan-{{$k}}">Save changes</button>
                                                    </div> --}}
                                                </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @else
                                        <tr>
                                            <th colspan="8" class="text-center">Data Tidak Ditemukan</th>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
          $('#selectAll').click(function (){ 
            $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
          });
          $('#aksi_selesai').click(function(){
            var jml = $('input[name="id_action[]"]:checked').length;
            if(jml < 1){
                alert('Silahkan Pilih data yang akan di publish');
            }else{
                r = confirm('Anda akan publish data?');
                if(r == true){
                    $('#aksi').val('selesai');
                    $('#a').submit();
                }
            }
            });
            $('#aksi_proses').click(function(){
              var jml = $('input[name="id_action[]"]:checked').length;
              if(jml < 1){
                  alert('Silahkan Pilih data yang akan di hidden');
              }else{
                  r = confirm('Anda akan hidden data?');
                  if(r == true){
                      $('#aksi').val('proses');
                      $('#a').submit();
                  }
              }
            });
            $('#aksi_delete').click(function(){
              var jml = $('input[name="id_action[]"]:checked').length;
              if(jml < 1){
                  alert('Silahkan Pilih data yang akan di hapus');
              }else{
                  r = confirm('Anda akan hapus data?');
                  if(r == true){
                      $('#aksi').val('d');
                      $('#a').submit();
                  }
              }
            });
        })
    </script>
@endsection