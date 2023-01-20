@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Data Hasil Input RawatInap') }}</div>
        <div class="card-body">
            <a href="/exportpdf2" class="btn btn-info mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
            <a href=" {{ route('rawatinap.recycle') }} " class="btn btn-secondary mb-4"><i class="fa fa-trash"></i>recycle Bin</a>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NO PEMERIKSAAN</th>
                        <th>NAMA</th>
                        <th>KELAS</th>
                        <th>NAMA RUANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($rawat_inap as $rawat_inaps)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$rawat_inaps->pemeriksaan_id}}</td>
                        <td>{{$rawat_inaps->nama_pasien}}</td>
                        <td>{{$rawat_inaps->kelas}}</td>
                        <td>{{$rawat_inaps->nama_ruangan}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-danger" onclick="deleteConfirmation(' {{$rawat_inaps->id}}', '{{$rawat_inaps->nama_pasien}}')">Hapus</button>
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
                                <label for="nama">Nama Pasien</label>
                                <input type="text" class="form-control" name="nama" id="nama" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label><br>
                                <select class="form-select " aria-label=".form-select-lg example" name="roles_id" id="roles_id" required>
                                    <option selected>Pilih Kelas</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_ruangan">Ruangan</label><br>
                                <select class="form-select " aria-label=".form-select-lg example" name="roles_id" id="roles_id" required>
                                    <option selected></option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                </select>
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

    function deleteConfirmation(id, nama) {
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
                    url: "/perawat/rawatInap/delete/" + id,
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