@extends('adminlte::page')

@section('title', 'AdminLTE')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3 class="fw-bold">Welcome</h3></div>

                <div class="card-body">
                    @if ($user->roles_id == 1)
                    <div class="alert alert-success" role="alert">
                        {{ __('You are logged in! as Admin') }} {{Auth::user()->nama}}
                    </div>
                    @elseif($user->roles_id == 2)
                    <div class="alert alert-success" role="alert">
                        {{ __('You are logged in! as Perawat') }} {{Auth::user()->nama}}
                    </div>
                    @elseif($user->roles_id == 3)
                    <div class="alert alert-success" role="alert">
                        {{ __('You are logged in! as Dokter') }} {{Auth::user()->nama}}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection