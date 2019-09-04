<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Pasar Jaya</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider" style="margin-top:10px;">

    <!-- Nav item - proses barang -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/data_pesanan'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Seluruh Transaksi</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- Nav item - proses barang -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/pesanan_masuk'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Verifikasi Pesanan</span></a>
    </li>

    <!-- Nav Item - cairkan dana -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin/cairkan_dana'); ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Data Pencairan Dana</span></a>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile Admin</span></a>
    </li>

    <!-- Data Users -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->