<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-detail" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<input type="hidden" class="form-control" name="id" id="id" value="<?= $roadmap->id ?>">
								<div class="form-group">
									<label for="code">Code</label>
									<input type="text" class="form-control" name="code" id="code" value="<?= $roadmap->code ?>" autocomplete="off" readonly
										placeholder="Enter Name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emp_id">Admin</label>
									<input type="text" class="form-control" name="emp_id" id="emp_id" autocomplete="off"
										placeholder="Enter Item Name" value="<?= ucwords($roadmap->name_of_employee) . ' - ' . $roadmap->company ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="date_send">Date Send</label>
									<input type="text" class="form-control" name="date_send" id="date_send" autocomplete="off"
										placeholder="Enter Item Name" value="<?= $roadmap->date_send ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="status">Status</label>
									<input type="text" class="form-control" name="status" id="status" autocomplete="off"
										placeholder="Enter Item Name" value="<?= $roadmap->status ?>" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="row mt-4">
									<div class="col-md-12">
										<h4>Detail Items </h4>
										<hr>
										<div class="table-responsive">
											<table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th>No</th>
														<th>Code</th>
														<th>Qty Sent</th>
														<th>Qty Received</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <a href="javascript:history.go(-1)" class="btn btn-danger" type="submit" name="submit"><i
                                class="fas fa-chevron-left"></i> Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir card -->
</div>
<!-- /.container-fluid -->
