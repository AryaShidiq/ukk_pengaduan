<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Pengaduan Dari {{$data['driTgl']}} Sampai Dengan {{$data['hgTgl']}}</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
                <th>Tanggal Pengaduan</th>
                <th>Kategori Pengaduan</th>
                <th>Judul Pengaduan</th>
                <th>NIK Pelapor</th>
                <th>Nama Pelapor</th>
                <th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['pengaduan'] as $k=>$v)
			<tr>
                <th>{{$k+1}}</th>
                <th>{{\Carbon\Carbon::parse($v->tgl_pengaduan)->format('j F Y')}}</th>
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
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>