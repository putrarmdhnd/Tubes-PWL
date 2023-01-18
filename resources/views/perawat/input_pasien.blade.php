@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Pengelolaan Pasien') }}</div>
        <div class="card-body">

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahPasienModal"><i class="fa fa-plus"></i>Tambah Data</button>
            <a href="/exportpdf"  class="btn btn-info mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
            <a href=" {{ route('recycle.bin') }} "  class="btn btn-secondary mb-4"><i class="fa fa-trash"></i>recycle Bin</a>

            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA LENGKAP</th>
                        <th>UMUR</th>
                        <th>JENIS KELAMIN</th>
                        <th>GOLONGAN DARAH</th>
                        <th>ALAMAT</th>
                        <th>TINGGI BADAN</th>
                        <th>BERAT BADAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($pasien as $PendataanPasien)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$PendataanPasien->nama}}</td>
                        <td>{{$PendataanPasien->umur}}</td>
                        <td>{{$PendataanPasien->jk}}</td>
                        <td>{{$PendataanPasien->goldar}}</td>
                        <td>{{$PendataanPasien->alamat}}</td>
                        <td>{{$PendataanPasien->TBadan}}</td>
                        <td>{{$PendataanPasien->BBadan}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-edit-pasien" class="btn btn-success " data-toggle="modal" data-target="#editPasienModal" data-id="{{ $PendataanPasien->id }}">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="deleteConfirmation(' {{$PendataanPasien->id}}', '{{$PendataanPasien->nama}}')">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--  TAMBAH DATA PASIEN MODAL   -->
<div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLable">Tambah Data Pasien</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('perawat.submit') }}" enctype="multipart/form-data">
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
                                <label for="tahun">Umur</label>
                                <input type="text" class="form-control" name="umur" id="umur" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="cover">Golongan Darah</label><br>
                                <select class="form-select " aria-label=".form-select-lg example" name="goldar" id="goldar" required>
                                    <option selected>Pilih Golongan Darah</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="O">O</option>
                                    <option value="AB">AB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Jenis Kelamin</label><br>
                                <select class="form-select " aria-label=".form-select-lg example" name="jk" id="jk" required>
                                    <option selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki_laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="penerbit">Nomor KTP</label>
                                <input type="text" class="form-control" name="NoKtp" id="NoKtp" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">No Handphone</label>
                                <input type="text" class="form-control" name="NoTlp" id="NoTlp" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Email</label>
                                <input type="text" class="form-control" name="email" id="email" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="cover">BERAT BADAN</label>
                                <input type="text" class="form-control" name="BBadan" id="BBadan" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">TINGGI BADAN</label>
                                <input type="text" class="form-control" name="TBadan" id="TBadan" required />
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

<!--  UPDATE DATA PASIEN MODAL   -->
<div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLable">Edit Data Pasien</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('perawat.update') }}" enctype="multipart/form-data">
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
                                <label for="tahun">Umur</label>
                                <input type="text" class="form-control" name="umur" id="edit-umur" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="cover">Golongan Darah</label><br>
                                <select class="form-select " aria-label=".form-select-lg example" name="goldar" id="edit-goldar" required>
                                    <option selected>Pilih Golongan Darah</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="O">O</option>
                                    <option value="AB">AB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Jenis Kelamin</label><br>
                                <select class="form-select " aria-label=".form-select-lg example" name="jk" id="edit-jk" required>
                                    <option selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki_laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="penerbit">Nomor KTP</label>
                                <input type="text" class="form-control" name="NoKtp" id="edit-NoKtp" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" id="edit-pekerjaan" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">No Handphone</label>
                                <input type="text" class="form-control" name="NoTlp" id="edit-NoTlp" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Email</label>
                                <input type="text" class="form-control" name="email" id="edit-email" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="cover">BERAT BADAN</label>
                                <input type="text" class="form-control" name="BBadan" id="edit-BBadan" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">TINGGI BADAN</label>
                                <input type="text" class="form-control" name="TBadan" id="edit-TBadan" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="cover">ALAMAT</label>
                                <textarea class="form-control" placeholder="Masukan Alamat" name="alamat" id="edit-alamat"></textarea>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <!--<input type="hidden" name="old_cover" id="edit-old-cover">-->

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

        $(document).on('click', '#btn-edit-pasien', function() {
            let id = $(this).data('id');

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
                    url: "pasien/delete/" + id,
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