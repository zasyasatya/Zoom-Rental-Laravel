<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-video"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIM Peminjaman Zoom</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $id_page == "home" ? "active" : "" }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(Auth::user()->level == "staff")
    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Staff
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $id_page == "zoom" ? "active" : "" }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Fitur:</h6>
                <a class="collapse-item" href="{{ route('zoom.index') }}">Data Akun Zoom</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ $id_page == "peminjaman" ? "active" : "" }}">
        <a class="nav-link" href="{{ route('peminjaman.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Peminjaman</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    @endif

    @if (Auth::user()->level == "mahasiswa")        
    <!-- Divider -->
    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Mahasiswa
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ $id_page == "pengajuan" ? "active" : "" }}">
        <a class="nav-link" href="{{ route('pengajuan.index') }}">
            <i class="fas fa-fw fa-clock"></i>
            <span>Pengajuan Peminjaman</span></a>
    </li>

    <li class="nav-item {{ $id_page == "zoom" ? "active" : "" }}">
        <a class="nav-link" href="{{ route('zoom.mindex') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>List Zoom</span></a>
    </li>

    @endif

        <!-- Heading -->
    <div class="sidebar-heading">
        Fitur Umum
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ $id_page == "jadwal" ? "active" : "" }}">
        <a class="nav-link" href="{{ route('jadwal.index') }}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Jadwal Peminjaman</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
