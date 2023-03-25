<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
	<form id="form-acc" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Accepted request & Create Roadmap
                </div>
                <div class="card-body">
						<div class="row">
							<div class="col-6">
								<input type="hidden" name="id" id="id" value="<?= $request->id ?>">
								<div class="form-group">
									<label for="code">Code</label>
									<input type="text" class="form-control" name="code" id="code" value="<?= $code ?>" autocomplete="off"
										readonly placeholder="Enter Name">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Date Send</label>
									<input type="date" class="form-control" name="date_send" id="date_send" autocomplete="off"
										placeholder="Enter Item Name" value="<?= date('Y-m-d') ?>">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Applicant</label>
									<input type="hidden" name="emp_id" value="<?= $user['id'] ?>">
									<input type="text" class="form-control" name="" id="" autocomplete="off"
										placeholder="Enter Item Name" value="<?= $user['name_of_employee'] . ' - ' . $user['company'] ?>" readonly>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Status</label>
									<select name="status" class="form-control" id="status">
										<option value="">Choose status</option>
										<option value="1">Processed</option>
										<option value="2">Sent</option>
									</select>
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

					<div class="datatable table-responsive mt-2">
						<table id="detail_material_table" class="table table-striped table-bordered dt-responsive nowrap"
							cellspacing="0" style="width:100%">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Qty Requested</th>
									<th class="text-center">Qty Sent</th>
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
											</td>

											<td>
												<input type="text" class="form-control " name="qty_requested[]" type="text" id="qty_requested<?= $i ?>" value="<?= $value->qty_requested ?>" readonly>
											</td>

											<td>
												<input type="text" class="form-control " name="qty_sent[]" type="text" id="qty_sent<?= $i ?>" value="<?= $value->qty_requested ?>">
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


<?php include('field_js.php') ?>
