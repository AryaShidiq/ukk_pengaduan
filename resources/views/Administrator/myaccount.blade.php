@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card">
            <div class="card-body">
                <div class="col-md-3">
                      Nama 
                </div>
                <div class="col-md-8">
                    <span class="badge badge-danger">
                        {{$data['nama_petugas']}}
                    </span>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection