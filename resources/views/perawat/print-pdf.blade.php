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

<h1>Data Pasien</h1>

<table id="customers">
  <tr>
    <th>no</th>
    <th>nama</th>
    <th>umur</th>
    <th>jenis kelamin</th>
    <th>goldar</th>
    <th style="text-align: center;">alamat</th>
    <th>tinggi badan</th>
    <th>berat badan</th>
  </tr>
  @php $no=1; @endphp
  @foreach($pasien as $PendataanPasien)
  <tr style="text-align: center;">
  <td>{{$no++}}</td>
    <td>{{$PendataanPasien->nama}}</td>
    <td>{{$PendataanPasien->umur}}</td>
    <td>{{$PendataanPasien->jk}}</td>
    <td>{{$PendataanPasien->goldar}}</td>
    <td>{{$PendataanPasien->alamat}}</td>
    <td>{{$PendataanPasien->TBadan}}</td>
    <td>{{$PendataanPasien->BBadan}}</td>
</tr>
  @endforeach
</table>

</body>
</html>


