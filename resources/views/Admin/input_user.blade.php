@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
  <div class="card card-default">
    <div class="card-header">{{ __('Pengelolaan Buku') }}</div>
    <div class="card-body">
      <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>Tambah Data</button>
      <a href="/exportPDF" class="btn btn-info mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
      <table id="table-data" class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th>NO</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>NO_HP</th>
            <th>JABATAN</th>
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
            <td>{{$user->no_hp}}</td>
            <td>{{$user->jabatan}}</td>
            <td>{{$user->jk}}</td>
            <td>{{$user->umur}}</td>
            <td>{{$user->alamat}}</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" id="btn-edit-user" class="btn btn-success " data-toggle="modal" data-target="#ediUserModal" data-id="{{ $user->id }}">Edit</button>
                <button type="button" class="btn btn-danger" onclick="deleteConfirmation(' {{$user->id}}', '{{$user->nama}}' )">Hapus</button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!--  TAMBAH DATA USER MODAL   -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLable">Tambah Data Pasien</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.submit') }}" enctype="multipart/form-data">
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tahun">Email</label>
                <input type="text" class="form-control" name="email" id="email" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="penerbit">Nomor HP</label>
                <input type="text" class="form-control" name="no_hp" id="no_hp" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="penerbit">Password</label>
                <input type="text" class="form-control" name="password" id="password" required />
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="roles_id">ROLE</label><br>
                <select class="form-select " aria-label=".form-select-lg example" name="roles_id" id="roles_id" required>
                  <option selected>Pilih Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Perawat</option>
                  <option value="3">Dokter</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cover">Jenis Kelamin</label><br>
                <select class="form-select " aria-label=".form-select-lg example" name="jk" id="jk" required>
                  <option selected>Pilih Jenis Kelamin</option>
                  <option value="L">L</option>
                  <option value="P">P</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cover">UMUR</label>
                <input type="text" class="form-control" name="umur" id="umur" required />
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="penerbit">JABATAN</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" required />
              </div>
            </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="cover">ALAMAT</label>
                <textarea class="form-control" placeholder="Masukan Alamat" name="alamat" id="alamat"></textarea>
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

<!--  UPDATE DATA USER MODAL   -->
<div class="modal fade" id="ediUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLable">Edit Data User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('admin.user.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="edit-nama" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tahun">Email</label>
                <input type="text" class="form-control" name="email" id="edit-email" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="penerbit">Nomor HP</label>
                <input type="text" class="form-control" name="no_hp" id="edit-no_hp" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="penerbit">Password</label>
                <input type="text" class="form-control" name="password" id="edit-password" required />
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="roles_id">ROLE</label><br>
                <select class="form-select " aria-label=".form-select-lg example" name="roles_id" id="edit-roles_id" required>
                  <option selected>Pilih Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Perawat</option>
                  <option value="3">Dokter</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cover">Jenis Kelamin</label><br>
                <select class="form-select " aria-label=".form-select-lg example" name="jk" id="edit-jk" required>
                  <option selected>Pilih Jenis Kelamin</option>
                  <option value="L">L</option>
                  <option value="P">P</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cover">UMUR</label>
                <input type="text" class="form-control" name="umur" id="edit-umur" required />
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label for="penerbit">JABATAN</label>
                <input type="text" class="form-control" name="jabatan" id="edit-jabatan" required />
              </div>
              </div>
            <div class="col-md-12">
            <div class="form-group">
                <label for="cover">ALAMAT</label>
                <textarea class="form-control" placeholder="Masukan Alamat" name="alamat" id="edit-alamat"></textarea>
            </div>
            </div>
          </div>

          <div class="modal-footer">
            <input type="hidden" name="id" id="edit-id">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(function() {

    $(document).on('click', '#btn-edit-user', function() {
      let id = $(this).data('id');

      $.ajax({
        type: "get",
        url: "{{ url('/admin/ajaxadmin/dataUser')}}/" + id,
        dataType: 'json',
        success: function(res) {

          $('#edit-nama').val(res.nama);
          $('#edit-email').val(res.umur);
          $('#edit-no_hp').val(res.no_hp);
          $('#edit-jabatan').val(res.jabatan);
          $('#edit-password').val(res.password);
          $('#edit-jk').val(res.jk);
          $('#edit-umur').val(res.umur);
          $('#edit-alamat').val(res.alamat);
          $('#edit-roles_id').val(res.roles_id);
          $('#edit-id').val(res.id);


        },
      });
    });
  });

  function deleteConfirmation(id, nama) {
    swal.fire({
      title: "Hapus?",
      type: 'warning',
      text: "Apakah anda yakin akan menghapus data user dengan nama " + nama + "!?",

      showCancelButton: !0,
      confirmButtonText: "Ya, lakukan!",
      cancelButtonText: "Tidak, batalkan!",
      reverseButtons: !0
    }).then(function(e) {

      if (e.value === true) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          type: 'POST',
          url: "users/delete/" + id,
          data: {
            _token: CSRF_TOKEN
          },
          dataType: 'JSON',
          success: function(results) {
            if (results.success === true) {
              swal.fire("Done!", results.massage, "success");

              //referesh page after 2 seconds
              setTimeout(function() {
                location.reload();
              }, 1000);
            } else {
              swal.fire("Error!", results.message, "error");
            }
          }
        });

      } else {
        e.dismiss;
      }
    }, function(dismiss) {
      return false;
    });
  }
</script>
@stop