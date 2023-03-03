@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h5 text-end">@if(empty($data['id'])) Buat Tanggapan @else Edit Tanggapan @endif</div>
                    <a href="{{$data['urlCancel']}}" class="btn btn-secondary"><i class="mdi mdi-arrow-left"></i></a>
                    <form action="{{$data['urlForm']}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="mb-3">
                          <label for="" class="form-label">Tanggal Tanggapan</label>
                          <input type="text" name="tgl_tanggapan" readonly value="{{old('tgl_tanggapan') ?? $data['tgl_tanggapan']}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
                          {{-- <input type="datetime-local" name="tgl_pengaduan" id="" value="{{old('tgl_pengaduan') ?? $data['tgl_pengaduan']}}"> --}}
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Tanggal Pengaduan</label>
                          <input type="date" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" name="tgl_pengaduan" value="{{old('tgl_pengaduan') ?? $data['tgl_pengaduan']}}" id="" class="form-control" placeholder="" aria-describedby="helpId" id="tgl_pengaduan">
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Judul Pengaduan</label>
                          {{-- <select name="id_pengaduan" id="" class="form-control select2 bg-light">
                            <option value="" selected> -- Pilih Judul Pengaduan -- </option>
                            @foreach ($data['id_pengaduan'] as $k=>$v)
                                <option value="{{$v->id_pengaduan}}">{{$v->judul_pengaduan}}</option>
                            @endforeach
                          </select> --}}
                            <select name="id_pengaduan" id="" class="form-control select2 bg-light">
                                
                            </select>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Tanggapan</label>
                          <textarea class="form-control" name="tanggapan" id="" rows="30" cols="15">{{old('tanggapan') ?? $data['tanggapan']}}</textarea>
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
    <script>
        $(function () {
            $("#tgl_pengaduan").on("change", function() {
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format( this.getAttribute("data-date-format") )
                )
            }).trigger("change");
            $('#tgl_pengaduan').on('change', function(){
                this.setAttribute(
                    "data-date",
                    moment(this.value, "YYYY-MM-DD")
                    .format( this.getAttribute("data-date-format") )
                )
                var date  = $(this).val();
                    if (date) {
                        $.ajax({
                            type: "GET",
                            url: "/tanggapan/ajax/"+date,
                            data: {"_token":"{{ csrf_token() }}"},
                            dataType: "json",
                            success: function (data) {
                                if (data) {
                                    $('#id_pengaduan').empty();
                                    $('#id_pengaduan').append('<option hidden value="0"> Choose Pricing Category </option>');
                                    $.each(data, function (key, pengaduan) { 
                                        $('#id_pengaduan').append('<option value="'+ pengaduan.id_pengaduan +'">' + pengaduan.judul_pengaduan +'</option>');
                                    });
                                }else{
                                    // $('#id_pengaduan').empty();
                                    $('#id_pengaduan').append('<option hidden value="0"> Choose Pricing Category </option>');
                                }
                            }
                        });
                    }
            });
        });
    </script>
@endsection