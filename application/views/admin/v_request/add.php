<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
	<form id="form-add" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Input data
                </div>
                <div class="card-body">
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
									<input type="text" class="form-control" name="date_order" id="date_order" autocomplete="off"
										placeholder="Enter Item Name" value="<?= date('Y-m-d') ?>" readonly>
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
									<label for="name">Note</label>
									<input type="text" class="form-control" name="type" id="type" autocomplete="off"
										placeholder="Enter Notes">
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

<script type="text/javascript">
	// define variable table
	var table;
	var table_modal;

	// define datatable is empty
	var count_list_material = 0;

	checkCountListMaterial();

	$(document).on("click",".choose_material",function(){
		count_list_material = count_list_material + 1;
		
		var id_material = $(this).attr("data-id");
        var material_name = $(this).attr("data-name");
        var material_price = $(this).attr("data-price");
		
		detail_material_html = `
            <tr id="list_detail_material` + count_list_material + `">
                <td>
					<input type="hidden" class="form-control" name="material_id[]" type="text" id="material_id` + count_list_material + `" value="`+id_material+`" readonly>
                    <input type="text" class="form-control" name="material_name[]" type="text" id="material_name` + count_list_material + `" value="`+material_name+`" readonly>
					<input type="hidden" class="form-control" name="material_price[]" type="text" id="material_price` + count_list_material + `" value="`+material_price+`" readonly>
                </td>
                <td>
                    <input type="text" class="form-control " name="qty_requested[]" type="text" id="qty_requested` + count_list_material + `">
                </td>
                <td style="text-align: center;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger btn-xs" onclick="removeDetailMaterial('material_detail` + count_list_material + `');">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        $('#detail_material').append(detail_material_html);

		$('#modal_material').modal('hide');

        checkCountListMaterial();
    });

	function removeDetailMaterial(id_row_detail_material = '') {
        count_list_material = count_list_material - 1;
        $('#'+id_row_detail_material).remove();
        checkCountListMaterial();
    }

	function checkCountListMaterial() {
        if (count_list_material == 0) {
            $('#detail_material').html(`
                <tr id="list_detail_material">
                    <td colspan="4" style="text-align: center">
                        Belum Ada Data
                    </td>
                </tr>
            `);
        } else {
            $('#list_detail_material').remove();
        }
    }

	$(document).ready(function() {
		// define datatable for modal
		table_modal = $('#modal_item').DataTable({
				"processing": true, //Feature control the processing indicator.
				"order": [], //Initial no order.
				oLanguage: {
				sProcessing: "<img src='<?php base_url();?>assets/tambahan/gambar/loading.gif' width='30px'>",
				"oPaginate": {
					"sPrevious": "Prev"
				},
				"sEmptyTable": "Data tidak ada di server"
					},

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('Request/ajax_list_modal')?>",
					"type": "POST"
					
				},

				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
				],
			});
	});

// process add data order
$('#form-add').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Request/prosesAdd'); ?>',
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
                Swal.fire({
					title: "Data saved successfully!",
					text: "Click the Ok button to continue!",
					icon: "success",
					button: "Ok",
				}).then(function() {
					var link = '<?php echo base_url("request/") ?>';
					window.location.replace(link);
				});
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
