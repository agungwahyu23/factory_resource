<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3"> Factory System</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Master -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('chef') ?>">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Item Management</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('promo') ?>">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Warehouse Issue Management</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('admin-package') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Manage Email</span>
        </a>
    </li>

    <!-- Transcation -->
    <li class="nav-item">
        <a class="nav-link" href="<?= site_url('setting') ?>">
            <i class="fas fa-cog fa-fw"></i>
            <span>Website Setting</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
