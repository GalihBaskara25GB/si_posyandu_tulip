<html>
<head>
	<title>Laporan Data Kriteria</title>
	<link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Data Kriteria</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
        <th class="font-weight-bold">#</th>
        <th class="font-weight-bold">Nama</th>
        <th class="font-weight-bold">Status</th>
        <th class="font-weight-bold">Pendidikan</th>
        <th class="font-weight-bold">Penyakit Berat</th>
        <th class="font-weight-bold">Pengetahuan Kesehatan</th>
        <th class="font-weight-bold">Keaktifan Sosial</th>
        <th class="font-weight-bold">Keahlian Komputer</th>
        <th class="font-weight-bold">Kepribadian</th>
        <th class="font-weight-bold">Kepemilikan HP</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach ($kriterias as $kriteria)
        <tr>
					<th class="font-weight-bold">{{ $i++ }}</th>
					<td>{{ $kriteria->kader->nama }}</td>
					<td>{{ ($kriteria->kader->is_verified) ? 'Sudah' : 'Belum' }} Diverifikasi</td>
					<td>{{ $kriteria->pendidikan }}</td>
					<td>{{ $kriteria->penyakit_berat }}</td>
					<td>{{ $kriteria->pengetahuan_kesehatan }}</td>
					<td>{{ $kriteria->keaktifan_sosial }}</td>
					<td>{{ $kriteria->keahlian_komputer }}</td>
					<td>{{ $kriteria->kepribadian }}</td>
					<td>{{ $kriteria->mempunyai_hp }}</td>
        </tr>
      @endforeach
		</tbody>
	</table>

</body>
</html></textarea>