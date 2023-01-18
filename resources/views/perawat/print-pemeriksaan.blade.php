<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Data Pemeriksaan Pasien</h1>

<table id="customers">
<thead>
 <tr class="text-center">
<th>NO</th>
 <th>NAMA PASIEN</th>
 <th>KELUHAN</th>
 <th>KETERANGAN PENYAKIT</th>
 <th>RESEP OBAT</th>
 <th>STATUS DIRAWAT</th>
</tr>
</thead>
@php $no=1; @endphp
 @foreach($periksa as $Pemeriksaan)
 <tr>
<td>{{$no++}}</td>
<td>{{$Pemeriksaan->nama_pasien}}</td>
<td>{{$Pemeriksaan->keluhan}}</td>
<td>{{$Pemeriksaan->keterangan_penyakit}}</td>
<td>{{$Pemeriksaan->resep_obat}}</td>
<td>
 @if($Pemeriksaan->status_dirawat == 1)
{{ ('Dirawat') }}
@else
{{ ('Tidak Dirawat') }}
@endif
</tr>
 @endforeach
</table>

</body>
</html>


