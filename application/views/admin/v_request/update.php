<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
	<form id="form-edit" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Edit data
                </div>
                <div class="card-body">
						<div class="row">
							<div class="col-6">
								<input type="hidden" name="id" id="id" value="<?= $request->id ?>">
								<div class="form-group">
									<label for="code">Code</label>
									<input type="text" class="form-control" name="code" id="code" value="<?= $request->code ?>" autocomplete="off"
										readonly placeholder="Enter Name">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Date Order</label>
									<input type="text" class="form-control" name="date_order" id="date_order" autocomplete="off"
										placeholder="Enter Item Name" value="<?= $request->date_order ?>" readonly>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Applicant</label>
									<input type="text" class="form-control" name="" id="" autocomplete="off"
										placeholder="Enter Item Name" value="<?= $request->emp_id ?>" readonly>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Note</label>
									<input type="text" class="form-control" name="type" id="type" autocomplete="off"
										placeholder="Enter Notes" value="<?= $request->type ?>">
								</div>
							</div>
						</div>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- akhir card -->

	<div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Detail Item
				</div>
				<div class="card-body">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add material</button>

					<div class="datatable table-responsive mt-2">
						<table id="detail_material_table" class="table table-striped table-bordered dt-responsive nowrap"
							cellspacing="0" style="width:100%">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Qty Requested</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody id="detail_material">
								<?php 
								$i = 1; 
								if (isset($detail)) {
									foreach ($detail as $key => $value) {?>
										<tr id="list_detail_material<?= $i ?>">
											<td>
												<input type="hidden" class="form-control " name="material_id[]" type="text" id="material_id<?= $i ?>" value="<?= $value->material_id ?>">
												<input type="text" class="form-control " name="material_name[]" type="text" id="material_name<?= $i ?>" value="<?= $value->name ?>" readonly>
												<input type="hidden" class="form-control " name="material_price[]" type="text" id="material_price<?= $i ?>" value="<?= $value->saved_price ?>" >
											</td>

											<td>
												<input type="text" class="form-control " name="qty_requested[]" type="text" id="qty_requested<?= $i ?>" value="<?= $value->qty_requested ?>">
											</td>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-danger btn-xs" onclick="removeDetailMaterial('list_detail_material<?= $i ?>')">
														<i class="fa fa-trash"></i>
													</button>
												</div>
											</td>
										</tr>	
									<?php $i++; } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
				<button class=" btn btn-primary mr-2" type="submit" id="btnSubmit" name="submit"><i
                                class="fas fa-save"></i>
                            Save</button>

                        <a href="javascript:history.go(-1)" class="btn btn-danger" type="submit" name="submit"><i
                                class="fas fa-chevron-left"></i> Back
                        </a>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal_material" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Material</h5>
			</div>
			<div class="modal-body">
				<div class="datatable table-responsive">
					<table id="modal_item" class="table table-striped table-bordered dt-responsive nowrap"
						cellspacing="0" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Code</th>
								<th>Name</th>
								<th>Price</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<?php include('field_js.php') ?>
