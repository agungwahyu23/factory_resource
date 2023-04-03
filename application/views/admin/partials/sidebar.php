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

	<?php 
	$session = $this->session->userdata();?>

	<!-- sidebar untuk produksi -->
	<?php if ($this->session->userdata('level') == 1) { ?>
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('item') ?>">
				<i class="fas fa-fw fa-box"></i>
				<span>Item Management</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('material') ?>">
				<i class="fas fa-fw fa-box"></i>
				<span>TTB Management</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('roadmap') ?>">
				<i class="fas fa-fw fa-truck"></i>
				<span>Roadmap</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
				aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-business-time"></i>
				<span>Warehouse Issue Management</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="<?= site_url('request') ?>">Request</a>
					<a class="collapse-item" href="<?= site_url('return') ?>">Return</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<!-- sidebar untuk gudang -->
	<?php if ($this->session->userdata('level') == 2) { ?>
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('material') ?>">
				<i class="fas fa-fw fa-box"></i>
				<span>TTB Management</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= site_url('roadmap') ?>">
				<i class="fas fa-fw fa-truck"></i>
				<span>Roadmap</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
				aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-business-time"></i>
				<span>Warehouse Issue Management</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="<?= site_url('request') ?>">Request</a>
					<a class="collapse-item" href="<?= site_url('return') ?>">Return</a>
				</div>
			</div>
		</li>
	<?php } ?>

	<?php if ($this->session->userdata('level') == 3) { ?>
	<li class="nav-item">
        <a class="nav-link" href="<?= site_url('user') ?>">
            <i class="fas fa-users fa-fw"></i>
            <span>Employee</span></a>
    </li>
	<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
				aria-expanded="true" aria-controls="collapseReport">
				<i class="fas fa-clipboard-list"></i>
				<span>Report</span>
			</a>
			<div id="collapseReport" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="<?= site_url('report-return') ?>">Return</a>
					<a class="collapse-item" href="<?= site_url('report-request') ?>">Request</a>
				</div>
			</div>
		</li>
	<?php } ?>

    <!-- Transcation -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= site_url('setting') ?>">
            <i class="fas fa-cog fa-fw"></i>
            <span>Website Setting</span></a>
    </li> -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
