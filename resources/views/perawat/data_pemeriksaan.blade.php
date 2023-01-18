@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Data Pemeiksaan') }}</div>
        <div class="card-body">
            <a href="/exportpdf1"  class="btn btn-info mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
            <a href=" {{ route('bin.recycle') }} "  class="btn btn-secondary mb-4"><i class="fa fa-trash"></i>recycle Bin</a>

            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA PASIEN</th>
                        <th>KELUHAN</th>
                        <th>KETERANGAN PENYAKIT</th>
                        <th>RESEP OBAT</th>
                        <th>STATUS DIRAWAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($periksa as $Pemeriksaan)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$Pemeriksaan->nama_pasien}}</td>
                        <td>{{$Pemeriksaan->keluhan}}</td>
                        <td>{{$Pemeriksaan->keterangan_penyakit}}</td>
                        <td>{{$Pemeriksaan->resep_obat}}</td>
                        <td>
                            @if($Pemeriksaan->status_dirawat == 1)
                            {{ ('Dirawat') }}
                            @else
                            {{ ('Tidak Dirawat') }}
                            @endif
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-danger" onclick="deleteConfirmation(' {{$Pemeriksaan->id}}', '{{$Pemeriksaan->nama_pasien}}')">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                    url: "perawat/periksa/delete/" + id,
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