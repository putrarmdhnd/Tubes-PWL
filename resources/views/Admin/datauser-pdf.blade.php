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
  background-color: #1C82AD;
  color: white;
}

</style>
</head>
<body>

<h1>Data User</h1>

<table id="customers">
  <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No_Hp</th>
            <th>Jabatan</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Alamat</th>
  </tr>
  @php $no=1; @endphp
  @foreach($users as $user)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$user->nama}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->no_hp}}</td>
            <td>{{$user->jabatan}}</td>
            <td>{{$user->jk}}</td>
            <td>{{$user->umur}}</td>
            <td>{{$user->alamat}}</td>
</tr>
  @endforeach
</table>

</body>
</html>


