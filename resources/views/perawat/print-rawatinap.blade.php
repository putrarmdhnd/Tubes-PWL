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

<h1>Data Rawat Inap</h1>

<table id="customers">
  <tr>
  <th style="text-align: center;">NO</th>
    <th  style="text-align: center;">NAMA</th>
    <th  style="text-align: center;">KELAS</th>
    <th style="text-align: center;">NAMA RUANGAN</th>
  </tr>
  @php $no=1; @endphp
    @foreach($rawat_inap as $rawat_inaps)
  <tr style="text-align: center;">
  <td>{{$no++}}</td>
    <td>{{$rawat_inaps->nama_pasien}}</td>
    <td>{{$rawat_inaps->kelas}}</td>
    <td>{{$rawat_inaps->nama_ruangan}}</td>
</tr>
  @endforeach
</table>

</body>
</html>


