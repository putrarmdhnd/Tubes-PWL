@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Recycle bin pemeriksaan') }}</div>
        <div class="pull-right">
        <a href="{{ url ('perawat/delete')}}" class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> delete all
        </a>
        <a href="{{ url ('perawat/restore')}}" class="btn btn-info btn-sm">
            <i class="fa fa-undo"></i> restore all
        </a>
        <a href="{{ url ('perawat/input-pasien')}}" class="btn btn-secondary btn-sm">
            <i class="fa fa-chevron-left"></i> back
        </a>
        </div>
        <div class="card-body">
           
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
                    @foreach($pemeriksaan as $Pemeriksaan)
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
