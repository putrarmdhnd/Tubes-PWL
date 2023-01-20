@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">{{ __('Data Pemeriksaan Dokter') }}</div>
        <div class="card-body">

            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>JENIS KELAMIN</th>
                        <th>ALAMAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php $no=1; @endphp
                    @foreach($dokter as $dokters)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$dokters->nama}}</td>
                        <td>{{$dokters->email}}</td>
                        <td>
                            @if($dokters->jk == 'L')
                            {{ ('Laki-laki') }}
                            @else
                            {{ ('Perempuan') }}
                            @endif
                        </td>
                        <td>{{$dokters->alamat}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button"  class="btn btn-success " data-toggle="modal" >
                                    <a href="/{{ $dokters->id }}/pasien" style="color: white; text-decoration: none;">Pasien</a>
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

@endsection
