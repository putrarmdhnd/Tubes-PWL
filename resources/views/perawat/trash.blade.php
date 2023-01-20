@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Recycle_bin Pasien') }}</div>
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
                            <div class="btn-group text-center" role="group" aria-label="Basic example">
                            <a href="{{ url ('perawat/restore/'.$PendataanPasien->id)}}" class="btn btn-info btn-sm">
                                 restore
                            </a>
                            <a href="{{ url ('perawat/delete/'.$PendataanPasien->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('yakin mau menghapus?')">
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
