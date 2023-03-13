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
              {{-- @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span>{!! Session::get('success') !!}</span>
                </div>
              @endif --}}
              @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                      {{-- Data Berhasil Di Simpan !!!  --}}
                      <span>{!! Session::get('success') !!}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if (Session::has('successSubmit'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                      {{-- Data Berhasil Di Simpan !!!  --}}
                      <span>{!! Session::get('successSubmit') !!}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if (Session::has('errorSubmit'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                  <div>
                    {{-- Data Berhasil Di Simpan !!!  --}}
                    <span>{!! Session::get('errorSubmit') !!}</span>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                          <th>Nama Category</th>
                          <th>Slug</th>
                          <th>Status</th>
                          <th>Add By</th>
                          <th>Edit By</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($kategori as $k=> $j)
                          <tr>
                            <td class="text-center">
                              <div class="form-check form-check-muted m-0">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="id[]" id="{{$j->id}}" value="{{$j->id}}">
                                </label>
                              </div>
                            </td>
                            <td>{{$k+1}}</td>
                            <td>{{$j->name}}</td>
                            <td>{{$j->slug}}</td>
                            <td>
                              @if ($j->status == 'p')
                                  <label for="" class="badge badge-success">Publish</label>
                              @elseif ($j->status == 'h')
                                  <label for="" class="badge badge-warning">Hidden</label>
                              @endif
                            </td>
                            <td>{{$j->addBy->nama_petugas}}</td>
                            @if (!empty($j->edit_by))
                              <td>{{$j->editBy->nama_petugas}}</td>
                            @else
                              <td> -- </td>
                            @endif
                            <td><a href="{{url('category/edit/'.$j->id)}}" class="btn btn-light btn-sm"><i class="mdi mdi-grease-pencil"></i></a></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {!! $kategori->links() !!}
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