<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pustaka Booking</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Looping Menu -->
    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->

        <?php if ($user['role_id'] == 1) : ?>
    <li class="nav-item">
        <a href="<?= base_url('admin'); ?>" class="nav-link pb-0">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
<?php endif; ?>

<li class="nav-item">
    <a class="nav-link pb-0" href="<?= base_url('buku'); ?>">
        <i class="fas fa-fw fa-book"></i>
        <span>Data Buku</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link pb-0" href="<?= base_url('buku/kategori'); ?>">
        <i class="fas fa-fw fa-book-open"></i>
        <span>Kategori Buku</span>
    </a>
</li>

<li class="nav-item">
    <a href="<?= base_url('user/anggota'); ?>" class="nav-link pb-0">
        <i class="fa fa-fw fa-user"></i>
        <span>Data Anggota</span>
    </a>
</li>

</li>
<!-- Divider -->
<hr class="sidebar-divider mt-3">


<!-- Heading -->
<div class="sidebar-heading">
    Transaksi
</div>
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a href="<?= base_url('pinjam'); ?>" class="nav-link pb-0">
            <i class="fa fa-fw fa-shopping-cart"></i>
            <span>Data Peminjaman</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('pinjam/daftarBooking'); ?>" class="nav-link pb-0">
            <i class="fa fa-fw fa-list"></i>
            <span>Data Booking</span>
        </a>
    </li>
</li>


<!-- Divider -->
<hr class="sidebar-divider mt-3">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->