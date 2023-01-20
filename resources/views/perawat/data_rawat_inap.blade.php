@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="container-fluid">
  <div class="card card-default">
    <div class="card-header">{{ __('INPUT DATA RAWAT INAP') }}</div>
    <div class="card-body">

      <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahPasienModal"><a href="{{ route('RawatInap.data') }}" style="color: white;"><i class="fa fa-book"></i> Data Hasil Input</a></button>
      <table id="table-data" class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th>NO</th>
            <th>NAMA PASIEN</th>
            <th>KETARANGAN PENYAKIT</th>
            <th>STATUS DIRAWAT</th>
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
                <button type="button" id="btn-input-rawat" class="btn btn-success " data-toggle="modal" data-target="#InputRawatInap" data-id="{{ $perawatans->id }}">Input</button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="InputRawatInap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLable">Tambah Data Pemeriksaan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('input.rawat_inap') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama_pasien" id="dataPasien-nama" readonly/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Kelas</label><br>
                                <select class="form-select" aria-label=".form-select-lg example" name="kelas" id="edit-jk" required>
                                    <option selected>Pilih Status</option>
                                    <option value="1">Kelas 1</option>
                                    <option value="2">Kelas 2</option>
                                    <option value="3">Kelas 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cover">Ruangan</label><br>
                                <select class="form-select" aria-label=".form-select-lg example" name="nama_ruangan" id="edit-jk" required>
                                    <option selected>Pilih Ruangan</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Matahari">Matahari</option>
                                    <option value="Bunga">Bunga</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="pemeriksaan_id" id="id_pemeriksaan">
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

    $(document).on('click', '#btn-input-rawat', function() {
      let id = $(this).data('id');

      $.ajax({
        type: "get",
        url: "{{ url('perawat/ajaxadmin/dataRawatInap')}}/" + id,
        dataType: 'json',
        success: function(res) {
          $('#dataPasien-nama').val(res.nama_pasien);
          $('#id_pemeriksaan').val(res.id);

        },
      });
    });
  });

</script>

<script>
    var select = document.getElementById("kelas");
    var selectedOption = select.options[select.selectedIndex].value;
    var selected_kelas = selectedOption;
</script> 

@stop