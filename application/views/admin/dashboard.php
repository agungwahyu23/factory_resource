<div class="col-xl-12 col-md-12 mb-12">
	<div class="alert alert-primary" role="alert">
		Welcome to the dashboard page, you are logged in as an <b><?= $name_of_employee ?></b>
	</div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-primary shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Item</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $item->item ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-boxes fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
						Material</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $material->material ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-cube fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-warning shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
						Request Submitted</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $req_sub->result ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-paper-plane fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-primary shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Request Accepted</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $req_acc->result ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-paper-plane fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-danger shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
						Request Rejected</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $req_rej->result ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-paper-plane fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-warning shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
						Return</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $return->result ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-sync fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
						Roadmap</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $roadmap->result ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-primary shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
						Employee</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $employee->result ?></div>
				</div>
				<div class="col-auto">
					<i class="fas fa-users fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>
