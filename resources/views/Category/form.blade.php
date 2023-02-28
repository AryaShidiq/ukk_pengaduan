@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-center">@if(empty($data['id'])) Create Category @else Edit Category @endif</h5>
                <a href="{{$data['urlCancel']}}" class="btn btn-secondary text-end"><i class="mdi mdi-arrow-left"></i></a>
                <form action="{{$data['urlForm']}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$data['id']}}">
                    <div class="mb-3">
                      <label for="" class="form-label">Name</label>
                      <input type="text" name="name" id="" class="form-control" placeholder="Name" aria-describedby="helpId" value="{{old('name') ?? $data['name']}}">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Slug</label>
                      <input type="text" name="slug" id="" class="form-control" placeholder="Slug" aria-describedby="helpId" value="{{old('slug') ?? $data['slug']}}">
                    </div>
                    <div class="form-group row mb-2">
                        <div class="ml-3 pt-1"><label>Status: </label></div>
                        <div class="icheck-success inline ml-2">
                            <input type="radio" id="radioSuccess1" name="status" value="p" @if(old('status') ?? $data['status'] == 'p') checked="checked" @endif checked>
                            <label for="radioSuccess1" class="font-weight-normal">Publish</label>
                        </div>
                        <div class="icheck-danger d-inline ml-3">
                            <input type="radio" id="radioDanger1" name="status" value="h" @if(old('status') ?? $data['status'] == 'h') checked="checked" @endif>
                            <label for="radioDanger1" class="font-weight-normal">Hidden</label>
                        </div>
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