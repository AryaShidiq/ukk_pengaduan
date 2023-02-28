@extends('layouts.main')

@section('content')
  <div class="card">
    <div class="card-header">
      <div class="page-header">
        <h3 class="page-title"> Basic Tables </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category tables</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-header">
              <div class="form-group">
                  <form action="GET" action="{{URL::current()}}">
                      <div class="btn-group">
                          <a href="{{url('category/create')}}" class="btn btn-sm text-light btn-primary"><i class="mdi mdi-plus"></i>Add</a>
                          <a href="javascript:void()" id="aksi_publish" type="button" class="btn btn-sm text-light btn-success"><i class="mdi mdi-check"></i>Publish</a>
                          <a href="javascript:void()" id="aksi_hidden" type="button" class="btn btn-sm text-light btn-warning"><i class="mdi mdi-alert-circle"></i> Hidden</a>
                          <a href="javascript:void()" id="aksi_delete" type="button" class="btn btn-sm text-light btn-danger"><i class="mdi mdi-delete"></i> Delete</a>
                      </div>
                  </form>
              </div>
              @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span>{!! Session::get('success') !!}</span>
                </div>
              @endif
            </div>
            <div class="card-body">
              <h4 class="card-title">Category Table</h4>
              </p>
              <form action="{{url('category/action')}}" id="a" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="aksi" id="aksi" value="">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="selectAll"></th>
                            <th>NO</th>
                            <th>Nama Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($kategori as $k=> $j)
                          <tr>
                            <td class="text-center"><input type="checkbox" name="id[]" id="{{$j->id}}" value="{{$j->id}}"></td>
                            <td>{{$k+1}}</td>
                            <td>{{$j->name}}</td>
                            <td>{{$j->slug}}</td>
                            <td>{{$j->status}}</td>
                            <td><a href="{{url('category/edit/'.$j->id)}}" class="btn btn-light btn-sm"><i class="mdi mdi-grease-pencil"></i></a></td>
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
    </div>
  </div>

  <script>
    $(function(){
      $('#selectAll').click(function (){ 
        $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
      });
      $('#aksi_publish').click(function(){
        var jml = $('input[name="id[]"]:checked').length;
        if(jml < 1){
            alert('Silahkan Pilih data yang akan di publish');
        }else{
            r = confirm('Anda akan publish data?');
            if(r == true){
                $('#aksi').val('p');
                $('#a').submit();
            }
        }
        });
        $('#aksi_hidden').click(function(){
          var jml = $('input[name="id[]"]:checked').length;
          if(jml < 1){
              alert('Silahkan Pilih data yang akan di hidden');
          }else{
              r = confirm('Anda akan hidden data?');
              if(r == true){
                  $('#aksi').val('h');
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