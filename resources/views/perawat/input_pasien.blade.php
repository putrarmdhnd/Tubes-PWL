@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Pengelolaan Buku') }}</div>
        <div class="card-body">
            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Tambah Data</button>
            <button class="btn btn-warning mb-4" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Update Data</button>
            <button class="btn btn-danger mb-4" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>Delete Data</button>
            <a href="" target="blank" class="btn btn-secondary mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>JENIS KELAMIN</th>
                        <th>NOMOR HP</th>
                        <th>TEMPAT TINGGAL</th>
                        <th>METODE PEMBAYARAN</th>
                        <th>PENANGGUNG JAWAB</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($users as $data)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->alamat}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-buku" class="btn btn-success " data-toggle="modal" data-target="#editBukuModal" data-id="">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="deleteConfirmation()">Hapus</button>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLable">Tambah Data Buku</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul">Nama Lengkap</label>
                                <input type="text" class="form-control" name="judul" id="judul" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">    
                                <label for="penulis">Tanggal Lahir</label>
                                <input type="text" class="form-control" name="penulis" id="penulis" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun">Umur</label>
                                <input type="text" class="form-control" name="tahun" id="tahun" required />
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerbit">Nomor KTP</label>
                                <input type="text" class="form-control" name="penerbit" id="penerbit" required />
                            </div>
                            </div>
                            <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Nomor BPJS</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Jenis Kelamin</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Agama</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Golongan Darah</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Pendidikan Trakhir</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Pekerjaan</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">No Handphone</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Email</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Metode Pembayaran</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Tempat Tinggal</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="cover">Anggota Keluarga</label>
                        <input type="text" class="form-control" name="cover" id="cover" required />
                    </div>
                    </div>
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