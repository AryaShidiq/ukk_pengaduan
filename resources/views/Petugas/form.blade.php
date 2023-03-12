@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-center">@if(empty($data['id'])) Create Data Petugas @else Edit Data Petugas @endif</h5>
                @if (Session::has('error'))
                  <div class="alert alert-danger">
                      {{-- <button type="button btn-danger" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
                      <span>{!! Session::get('error') !!}</span>
                  </div>
                @endif
                <a href="{{$data['urlCancel']}}" class="btn btn-secondary text-end"><i class="mdi mdi-arrow-left"></i></a>
                <form action="{{$data['urlForm']}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$data['id']}}">
                    <div class="mb-3">
                      <label for="" class="form-label">Nama Petugas</label>
                      <input type="text" name="nama_petugas" id="" class="form-control" placeholder="Nama Petugas" aria-describedby="helpId" value="{{old('nama_petugas') ?? $data['nama_petugas']}}">
                    @if ($errors->has('nama_petugas'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('nama_petugas') }}</strong>
                      </span>
                    @endif
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Email</label>
                      <input type="text" name="email" id="" class="form-control" placeholder="email" aria-describedby="helpId" value="{{old('email') ?? $data['email']}}">
                    @if ($errors->has('email'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">No Telfon</label>
                      <input type="text" name="telp" id="" class="form-control" placeholder="No Telfon" aria-describedby="helpId" value="{{old('telp') ?? $data['telp']}}">
                    @if ($errors->has('telp'))
                      <span class="help-block text-danger">
                        <strong>{{ $errors->first('telp') }}</strong>
                      </span>
                    @endif
                    </div>
                    <div class="form-group row mb-2">
                        <div class="ml-3 pt-1"><label>Level: </label></div>
                        <div class="icheck-success inline ml-2">
                            <input type="radio" id="radioSuccess1" name="level" value="admin" @if(old('level') ?? $data['level'] == 'admin') checked="checked" @endif checked>
                            <label for="radioSuccess1" class="font-weight-normal">Admin</label>
                        </div>
                        <div class="icheck-danger d-inline ml-3">
                            <input type="radio" id="radioDanger1" name="level" value="petugas" @if(old('level') ?? $data['level'] == 'petugas') checked="checked" @endif>
                            <label for="radioDanger1" class="font-weight-normal">Petugas</label>
                        </div>
                    @if ($errors->has('level'))
                        <span class="help-block text-danger">
                          <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection