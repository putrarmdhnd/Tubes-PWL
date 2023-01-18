@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Data Pasien Sortir') }}</div>
        <div class="card-body">
            <a href=" {{ route('perawat.export') }} " class="btn btn-info mb-4"><i class="fa fa-print"></i>Cetak PDF</a>
            <a href=" {{ route('recycle.bin') }} " class="btn btn-secondary mb-4"><i class="fa fa-trash"></i>recycle Bin</a>
            <a href="{{ url ('/data-dokter')}}" class="btn btn-secondary btn-sm mb-4">
                <i class="fa fa-chevron-left"></i> back
            </a>

            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th>KETERANGAN PENYAKIT</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($sortir as $sortirs)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$sortirs->nama_pasien}}</td>
                        <td>{{$sortirs->keterangan_penyakit}}</td>
                        <td>
                            @if($sortirs->status_dirawat == '1')
                            {{ ('Dirawat') }}
                            @elseif($sortirs->status_dirawat == '0')
                            {{ ('Tidak Dirawat') }}
                            @endif
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

@stop