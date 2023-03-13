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
            @if (Session::has('pdfail'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Data Tidak Ditemukan !!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::has('tanggapan_fail'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                    Tanggapan Error !!!
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <form action="GET" action="{{URL::current()}}">
                        <div class="btn-group">
                            {{-- <a href="{{url('pengaduan/create')}}" class="btn btn-sm text-light btn-primary"><i class="mdi mdi-plus"></i>Add</a> --}}
                            <a href="javascript:void()" id="aksi_selesai" type="button" class="btn btn-sm text-light btn-success"><i class="mdi mdi-check"></i>Selesai</a>
                            <a href="javascript:void()" id="aksi_proses" type="button" class="btn btn-sm text-light btn-warning"><i class="mdi mdi-alert-circle"></i> Proses</a>
                            <a href="javascript:void()" id="aksi_delete" type="button" class="btn btn-sm text-light btn-danger"><i class="mdi mdi-delete"></i> Delete</a>
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
            <div class="col-lg-12 my-3">
                <h6 class="text-center">FILTER DATA</h6>
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="{{URL::current()}}">
                    {{-- @csrf --}}
                    <div class="col-md-10 d-flex justify-content-around">
                        <div class="form-group">
                            {{-- <select name="sts" id="" class="js-example-basic-single"> --}}
                            <select name="sts" id="" class="">
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
                            {{-- <select name="ctg" id="" class="js-example-basic-single"> --}}
                            <select name="ctg" id="" class="">
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
                    <button class="btn btn-primary"><i class="mdi mdi-send"></i></button>
                </form>
            </div>
            <div class="col-lg-12 my-3">
                <h5 class="text-center mb-2">CETAK LAPORAN</h5>
                <form action="{{url('pengaduan/cetak-report')}}" method="GET" class="d-flex justify-content-around">
                    @csrf
                    <div class="form-group d-block">
                        {{-- <label for="">Dari Tanggal</label> --}}
                        <input type="date" name="driTgl" id="" value="{{old('driTgl')}}" required>
                    </div>
                    <div class="form-group d-block">
                        {{-- <label for="">Hingga Tanggal</label> --}}
                        <input type="date" name="hgTgl" id="" value="{{old('hgTgl')}}" required>
                    </div>
                    <button class="btn btn-danger"><i class="mdi mdi-printer"></i> Print</button>
                </form>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-header">
                  @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span>{!! Session::get('success') !!}</span>
                    </div>
                  @endif
                  @if (Session::has('warning'))
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <span>{!! Session::get('warning') !!}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  @if (Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <span>{!! Session::get('danger') !!}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  @if (Session::has('tanggapan_done'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span>{!! Session::get('tanggapan_done') !!}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  @if (Session::has('tanggapan_fail'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span>{!! Session::get('tanggapan_done') !!}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                </div>
                <div class="card-body">
                  <h4 class="card-title">Category Table</h4>
                  </p>
                  <form action="{{url('pengaduan/action')}}" id="a" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="aksi" id="aksi" value="">
                      <div class="table-responsive">
                        <table class="table my-4">
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
                            @foreach ($pengaduan as $k=> $v)
                                @if (count($pengaduan) > 0)
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="id[]" id="{{$v->id_pengaduan}}" value="{{$v->id_pengaduan}}">
                                            </label>
                                            </div>
                                        </td>
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
                                        @if ($v->status == 'proses')
                                            <form action="{{url('tanggapan/simpan')}}" method="post" id="tanggapan_{{$k+1}}">
                                                @csrf
                                                <input type="hidden" name="id_pengaduan" value="{{$v->id_pengaduan}}" form="tanggapan_{{$k+1}}">
                                            </form>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="exampleModal-{{$k+1}}" tabindex="-1" aria-labelledby="exampleModalLabel-{{$k+1}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Isi Laporan</label>
                                                            <textarea class="form-control" name="isi_laporan" id="" rows="3" form="tanggapan_{{$k+1}}"></textarea>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" form="tanggapan_{{$k+1}}">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </tr>
                                @else
                                    <tr>
                                        <th class="text-center" colspan="8">Data Tidak Ditemukan</th>
                                    </tr>
                                @endif
                            @endforeach
                          </tbody>
                        </table>
                        {{ $pengaduan->links() }}
                      </div>
                  </form>
                </div>
              </div>
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
        var jml = $('input[name="id[]"]:checked').length;
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
          var jml = $('input[name="id[]"]:checked').length;
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
          var jml = $('input[name="id[]"]:checked').length;
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