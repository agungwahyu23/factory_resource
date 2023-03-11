<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Input data
                </div>
                <div class="card-body">
                    <form id="form-add" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="code">Code</label>
									<input type="text" class="form-control" name="code" id="code" value="<?= $code ?>" autocomplete="off"
										readonly placeholder="Enter Name">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Date Order</label>
									<input type="text" class="form-control" name="name" id="name" autocomplete="off"
										placeholder="Enter Item Name" value="<?= date('Y-m-d') ?>" readonly>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Applicant</label>
									<input type="hidden" name="emp_id" value="<?= $user['id'] ?>">
									<input type="text" class="form-control" name="name" id="name" autocomplete="off"
										placeholder="Enter Item Name" value="<?= $user['name_of_employee'] . ' - ' . $user['company'] ?>" readonly>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="name">Type</label>
									<input type="text" class="form-control" name="name" id="name" autocomplete="off"
										placeholder="Enter Item Name">
								</div>
							</div>
							
						</div>
                        
                    </form>
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
					<button class=" btn btn-primary mr-2" type="submit" id="btnSubmit" name="submit"><i
							class="fas fa-save"></i>Add
						Item</button>

					<div class="datatable table-responsive mt-2">
						<table id="cart_table" class="table table-striped table-bordered dt-responsive nowrap"
							cellspacing="0" style="width:100%">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Item Code</th>
									<th class="text-center">Item Name</th>
									<th class="text-center">Qty Return</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
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
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
$('#form-add').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Item/prosesAdd'); ?>',
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
                document.getElementById("form-add").reset();
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
        var link = '<?php echo base_url("item") ?>';
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
<!-- <script>
$(document).ready(function() {
    $(".select").select2();
});
</script> -->
