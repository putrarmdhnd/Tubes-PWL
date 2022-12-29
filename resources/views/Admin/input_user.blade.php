@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
  <div class="card card-default">
    <div class="card-header">{{ __('Pengelolaan Buku') }}</div>
    <div class="card-body">
      <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Tambah Data</button>
      <a href="#" target="blank" class="btn btn-secondary mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
      <table id="table-data" class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th>NO</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>JENIS KELAMIN</th>
            <th>UMUR</th>
            <th>ALAMAT</th>
            <th>AKSI</th>
          </tr>
        </thead>
        <tbody class="text-center">
          @php $no=1; @endphp
          @foreach($users as $user)
          <tr>
            <td>{{$no++}}</td>
            <td>{{$user->nama}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->jk}}</td>
            <td>{{$user->umur}}</td>
            <td>{{$user->alamat}}</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" id="btn-edit-buku" class="btn btn-success " data-toggle="modal" data-target="#editBukuModal" data-id="">Edit</button>
                <button type="button" class="btn btn-danger" onclick="deleteConfirmation( )">Hapus</button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--  TAMBAH DATA BUKU MODAL   -->
<div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLable">Tambah Data Buku</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="judul">NAMA</label>
            <input type="text" class="form-control" name="judul" id="judul" required />
          </div>
          <div class="form-group">
            <label for="penulis">EMAIL</label>
            <input type="text" class="form-control" name="penulis" id="penulis" required />
          </div>
          <div class="form-group">
            <label for="tahun">JENIS KELAMIN</label>
            <input type="text" class="form-control" name="tahun" id="tahun" required />
          </div>
          <div class="form-group">
            <label for="penerbit">UMUR</label>
            <input type="text" class="form-control" name="penerbit" id="penerbit" required />
          </div>
          <div class="form-group">
            <label for="penerbit">ALAMAT</label>
            <input type="text" class="form-control" name="penerbit" id="penerbit" required />
          </div>
          <div class="form-group">
            <label for="penerbit" class="px-2">HAK AKSES </label>
            <select class="form-select" id="validationCustom04" required>
              <option selected disabled value="">Choose...</option>
              <option>DOKTER</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection