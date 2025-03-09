<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Dev Academy</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-user"></i>
            <span>Kelolah Akun</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.students') }}">Students</a>
                <a class="collapse-item" href="{{ route('admin.mentor') }}">Mentor</a>
                <a class="collapse-item" href="{{ route('admin.superadmin') }}">Superadmin</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Kategori -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.category') }}">
            <i class="fas fa-layer-group"></i>
            <span>Kategori Kelas</span></a>
    </li>

    <!-- Nav Item - Kelas -->
    <li class="nav-item ">
        <a class="nav-link" href="kelas.html">
            <i class="fas fa-fw fa-video"></i>
            <span>Kelolah Kelas</span></a>
    </li>

    <!-- Nav Item - Diskon -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.discount') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Diskon Kelas</span></a>
    </li>

    <!-- Nav Item - Tools Kelas -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.tools') }}">
            <i class="fas fa-fw fa-code"></i>
            <span>Tools Kelas</span></a>
    </li>

    <!-- Nav Item - Profesi -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.profession') }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Profesi Pengguna</span></a>
    </li>

    <!-- Nav Item - Profesi -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.transaction') }}">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>History Transaksi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
