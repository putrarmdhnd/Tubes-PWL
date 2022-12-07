@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

@section('body')
<div class="{{ $auth_type ?? 'login' }}-box">

    {{-- Logo --}}
    <div class="{{ $auth_type ?? 'login' }}-logo">
        <a href="{{ $dashboard_url }}">
            <img src="{{ URL::asset('/image/rsabhk-logo.png') }}" style="height: 10vh;" alt="logo">
        </a>
    </div>

    {{-- Card Box --}}
    <div class="card" style=" border-top: 3px solid #477138;">

        {{-- Card Header --}}
        @hasSection('auth_header')
        <div class="welcome mt-3 text-center">
            <h2>Selamat Datang</h2>
            <p>Silahkan login terlebih dahulu</p>
        </div>
        @endif

        {{-- Card Body --}}
        <div class="card-body  {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
            @yield('auth_body')
        </div>

        {{-- Card Footer --}}
        @hasSection('auth_footer')
        <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
            @yield('auth_footer')
        </div>
        @endif

    </div>

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
@stop