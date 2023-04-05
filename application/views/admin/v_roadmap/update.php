<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
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
									<select name="status" class="form-control" id="status">
										<option value="">Choose status</option>
										<option value="1" <?= $roadmap->status == 'Processed' ? 'selected' : '' ?>>Processed</option>
										<option value="2" <?= $roadmap->status == 'Sending' ? 'selected' : '' ?>>Sent</option>
									</select>
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
														<th>Material Name</th>
														<th>Qty Sent</th>
													</tr>
												</thead>
												<tbody id="detail_material">
												<?php 
												$i = 1; 
												if (isset($detail)) {
													foreach ($detail as $key => $value) {?>
														<tr id="list_detail_material<?= $i ?>">
															<td><?= $i ?></td>
															<td>
																<input type="text" class="form-control " name="code[]" type="text" id="code<?= $i ?>" value="<?= $value->code ?>" readonly>
															</td>
															<td>
																<input type="hidden" class="form-control " name="material_id[]" type="text" id="material_id<?= $i ?>" value="<?= $value->material_id ?>">
																<input type="text" class="form-control " name="material_name[]" type="text" id="material_name<?= $i ?>" value="<?= $value->name ?>" readonly>
															</td>
															<td>
																<input type="text" class="form-control " name="qty_sent[]" type="text" id="qty_sent<?= $i ?>" value="<?= $value->qty_sent ?>">
															</td>
														</tr>	
													<?php $i++; } ?>
												<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>

						<button class=" btn btn-primary mr-2" type="submit" id="btnSubmit" name="submit"><i
									class="fas fa-save"></i>
								Save</button>

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

<!-- this script for datatable edit -->
<script>
	// define datatable is empty
	var count_list_material = '';
	<?php if (isset($detail)) { ?>
		count_list_material = '<?php echo count($detail) ?>';
	<?php }else{ ?>
		count_list_material = 0;
	<?php } ?>
	console.log(count_list_material);
</script>

<!-- end this script for datatable edit -->


<script type="text/javascript">
$('#form-update').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Roadmap/prosesUpdate'); ?>',
            type: "post",
            enctype: "multipart/form-data",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function(data) {
            var result = jQuery.parseJSON(data);
            console.log(data);
            if (result.status == 'berhasil') {
                document.getElementById("form-update").reset();
                save_berhasil();
            } else {
                $(".loading2").hide();
                $(".loading2").modal('hide');
                gagal();

            }
        })
    e.preventDefault();
});
</script>

<script>
function save_berhasil() {
    Swal.fire({
        title: "Data saved successfully!",
        text: "Click the Ok button to continue!",
        icon: "success",
        button: "Ok",
    }).then(function() {
        var link = '<?php echo base_url("roadmap") ?>';
        window.location.replace(link);
    });
}

function gagal() {
    swal({
        title: "Data failed to save!",
        text: "Click the Ok button to continue!",
        icon: "danger",
        button: "Ok",
        dangerMode: true,
    });
}
</script>
