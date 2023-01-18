<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <form class="form-inline pt-2">
                    <div class="input-group">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    @if ($user->roles_id == 1)
                    <li class="nav-item pt-3">
                        <a href="{{ route('admin.input')}}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data User
                            </p>
                        </a>
                    </li>
                    @elseif($user->roles_id == 2)
                    <li class="nav-item pt-3">
                        <a href="{{ route('perawat.input') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Data Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item pt-3">
                        <a href="/data-dokter" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Data Dokter
                            </p>
                        </a>
                    </li>
                    <li class="nav-item pt-3">
                        <a href="{{ route('pemeriksaan.home') }}" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Data Pemeriksaan
                            </p>
                        </a>
                    </li>
                    @elseif($user->roles_id == 3)
                    <li class="nav-item pt-3">
                        <a href="{{ route('dokter.pemeriksaan') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Pemeriksaan
                            </p>
                        </a>
                    </li>
                    @endif
            </ul>
        </nav>
    </div>

</aside>