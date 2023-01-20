@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Recycle_bin Rawat Inap') }}</div>
        <div class="pull-right">
        <a href="{{ url ('perawat/delete_rawatinapPermanen')}}" class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> delete all
        </a>
        <a href="{{ url ('perawat/restore_rawatinap')}}" class="btn btn-info btn-sm">
            <i class="fa fa-undo"></i> restore all
        </a>
        <a href="{{ url ('data-input/rawat-inap')}}" class="btn btn-secondary btn-sm">
            <i class="fa fa-chevron-left"></i> back
        </a>
        </div>
        <div class="card-body">
           
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
                            <div class="btn-group text-center" role="group" aria-label="Basic example">
                            <a href="{{ url ('perawat/restore_rawatinap/'.$rawat_inaps->id)}}" class="btn btn-info btn-sm">
                                 restore
                            </a>
                            <a href="{{ url ('perawat/delete_rawatinapPermanen/'.$rawat_inaps->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('yakin mau menghapus?')">
                                 hapus permanen
                            </a>
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
