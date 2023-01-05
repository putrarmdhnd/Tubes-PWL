@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid mt-5">
    <div class="card card-default">
        <div class="card-header">{{ __('Input Pemeriksaan   ') }}</div>
        <div class="card-body">
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>UMUR</th>
                        <th>JK</th>
                        <th>GOL.DARAH</th>
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
                        <td>{{$PendataanPasien->TBadan}}</td>
                        <td>{{$PendataanPasien->BBadan}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" id="btn-tmbh-pemeriksaan" class="btn btn-success " data-toggle="modal" data-target="#tambahPemeriksaanModal" data-id="{{ $PendataanPasien->id }}">Periksa</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--  TAMBAH DATA PEMERIKSAAN MODAL   -->
<div class="modal fade" id="tambahPemeriksaanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLable">Tambah Data Pemeriksaan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('dokter.pemeriksaan.tambah') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="dataPasien-nama" disabled/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Keluhan</label>
                                <textarea class="form-control" placeholder="" name="keluhan" id="edit-nama" style="height: 100px"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Keterangan Penyakit</label>
                                <input type="text" class="form-control" name="keterangan_penyakit" id="edit-nama"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Resep Obat</label>
                                <textarea class="form-control" placeholder="" name="resep_obat" id="edit-nama" style="height: 100px"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Status Dirawat</label><br>
                                <select class="form-select" aria-label=".form-select-lg example" name="status_dirawat" id="edit-jk" required>
                                    <option selected>Pilih Status</option>
                                    <option value="1">Dirawat</option>
                                    <option value="0">Tidak Dirawat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="pasien_id" id="dataPasien-id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
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

        $(document).on('click', '#btn-tmbh-pemeriksaan', function() {
            let id = $(this).data('id');

            $.ajax({
                type: "get",
                url: "{{ url('pemeriksaan/ajaxadmin/dataPasien')}}/" + id,
                dataType: 'json',
                success: function(res) {
                    $('#dataPasien-nama').val(res.nama);
                    $('#dataPasien-id').val(res.id);

                },
            });
        });
    });
</script>
@stop