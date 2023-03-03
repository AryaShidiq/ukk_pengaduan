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
            <div class="row">
                <div class="col-ld-12">
                    <div class="form-group">
                        <form action="GET" action="{{URL::current()}}">
                            <div class="btn-group">
                                <a href="javascript:void()" class="btn btn-sm text-light btn-primary" id="aksi"><i class="mdi mdi-plus"></i></a>
                                <a href="javascript:void()" class="btn btn-sm text-light btn-success" id="aksi"><i class="mdi mdi-check"></i></a>
                                <a href="javascript:void()" class="btn btn-sm text-light btn-warning" id="aksi"><i class="mdi mdi-alert-circle"></i></a>
                                <a href="javascript:void()" class="btn btn-sm text-light btn-danger" id="aksi"><i class="mdi mdi-delete"></i></a>
                            </div>
                        </form>
                    </div>
                    <form action="{{url('pengaduan/action')}}" id="a" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="aksi" id="aksi" value="">
                        <div class="tabe-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" name="" id="selectAll"></th>
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
                                            <th class="text-center"><input type="checkbox" name="" id="{{$v['id_pengaduan']}}" value="{{$v['id_pengaduan']}}"></th>
                                            <th>{{$k+1}}</th>
                                            <th>{{$v->nik}}</th>
                                            <th>{{$v->nama}}</th>
                                            <th>{{$v->email}}</th>
                                            <th>{{$v->telp}}</th>
                                            <th>
                                                <a href="{{url('pengaduan/edit/'.$v->id_pengaduan)}}" class="btn btn-light btn-sm"><i class="mdi mdi-grease-pencil"></i></a>
                                                <a href="{{url('pengaduan/detail/'.$v->id_pengaduan)}}" class="btn btn-light btn-sm"><i class="mdi mdi-eye"></i></a>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection