@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="page-header">
                <h4 class="page-title">Data Akun Masyarakat </h4>
                <nav class="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Akun Masyarakat</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card-body">
            <div class="row ">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="btn-group">
                            <a href="javascript:void()" class="btn btn-sm text-light btn-danger" id="aksi_delete"><i class="mdi mdi-delete"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search" method="GET" action="{{URL::current()}}">
                        <input type="text" class="form-control" placeholder="Cari nama, nik atau email pelapor, Judul Pengaduan" name="q" value="{{old('q')}}">
                        <button class="btn btn-primary"><span class="mdi mdi-send"></span></button>
                    </form>
                </div>
                <div class="col-lg-12">
                    <form action="{{url('pengaduan/action')}}" id="a" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" id="aksi" value="">
                        <div class="tabe-responsive">
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
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Telfon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masyarakat as $k=>$v)
                                        <tr>
                                            <th class="text-center">
                                                <div class="form-check form-check-muted m-0">
                                                    <label class="form-check-label">
                                                      <input type="checkbox" class="form-check-input" name="" id="{{$v['id']}}" value="{{$v['id']}}">
                                                    </label>
                                                </div>
                                            </th>
                                            <th>{{$k+1}}</th>
                                            <th>{{$v->nik}}</th>
                                            <th>{{$v->nama}}</th>
                                            <th>{{$v->email}}</th>
                                            <th>{{$v->telp}}</th>
                                            <th>
                                                {{-- <a href="{{url('pengaduan/edit/'.$v->id)}}" class="btn btn-light btn-sm"><i class="mdi mdi-grease-pencil"></i></a> --}}
                                                <a href="javascript:void(0)" class="btn btn-light btn-sm"><i class="mdi mdi-eye"></i></a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $masyarakat->links() !!}
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