@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Data Pemeiksaan') }}</div>
        <div class="card-body">
        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahRawatModal"><i class="fa fa-plus"></i>Tambah Data</button>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>KETERANGAN PENYAKIT</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($perawatan as $perawatans)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$perawatans->nama_pasien}}</td>
                        <td>{{$perawatans->keterangan_penyakit}}</td>
                        <td>
                            @if($perawatans->status_dirawat == '1')
                            {{ ('Dirawat') }}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-pasien" class="btn btn-success " data-toggle="modal" data-target="#editBukuModal">
                                    <a href="" style="color: white; text-decoration: none;">Edit</a>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahRawatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <label for="penerbit">JABATAN</label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="cover">Pasien</label><br>
                <select class="form-select " aria-label=".form-select-lg example" name="jk" id="jk" required>
                  <option selected>Pilih Pasien</option>
                  @foreach($perawatan as $perawatans)
                  <option value="L">{{$perawatans->nama_pasien}}</option>
                  @endforeach
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
                <label for="cover">ALAMAT</label>
                <textarea class="form-control" placeholder="Masukan Alamat" name="alamat" id="alamat"></textarea>
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

@section('js')
<script>
    $(function() {

        $(document).on('click', '#btn-edit-pasien', function() {
            let id = $(this).data('id');

            $('#image-area').empty();

            $.ajax({
                type: "get",
                url: "{{ url('/perawat/ajaxadmin/dataPasien')}}/" + id,
                dataType: 'json',
                success: function(res) {
                    $('#edit-nama').val(res.nama);
                    $('#edit-umur').val(res.umur);
                    $('#edit-NoKtp').val(res.NoKtp);
                    $('#edit-jk').val(res.jk);
                    $('#edit-agama').val(res.agama);
                    $('#edit-goldar').val(res.goldar);
                    $('#edit-pekerjaan').val(res.pekerjaan);
                    $('#edit-NoTlp').val(res.NoTlp);
                    $('#edit-email').val(res.email);
                    $('#edit-alamat').val(res.alamat);
                    $('#edit-TBadan').val(res.TBadan);
                    $('#edit-BBadan').val(res.BBadan);
                    $('#edit-id').val(res.id);

                },
            });
        });
    });

    function deleteConfirmation(npm, nama) {
        swal.fire({
            title: "Hapus?",
            type: 'warning',
            text: "Apakah anda yakin akan menghapus data pasien dengan nama " + nama + "!?",

            showCancelButton: !0,
            confirmButtonText: "Ya, lakukan!",
            cancelButtonText: "Tidak, batalkan!",
            reverseButtons: !0
        }).then(function(e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "pasien/delete/" + npm,
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