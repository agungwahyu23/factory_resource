<!-- DataTales Example -->
<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
			<div class="row mb-5">
				<div class="col-md-6">
					<form id="form-add" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="item_id" value="<?= $id ?>" id="">
						<div class="form-group">
							<label for="name">Choose Material*</label>
							<select name="raw_material_id" id="raw_material_id" class="form-control">
								<option value="">Choose material</option>
								<?php foreach ($materials as $material) { ?>
									<option value="<?= $material->id ?>"><?= $material->name ?></option>
								<?php } ?>
							</select>
						</div>
						<button class=" btn btn-primary mr-2" type="submit" id="btnSubmit" name="submit"><i class="fas fa-save"></i>
							Save</button>
			
						<a href="<?= site_url('item') ?>" class="btn btn-success" type="submit" name="submit"><i
								class="fas fa-check"></i> Done
						</a>
					</form>
				</div>
			</div>
			<h4>Detail Material For Item <?= $item->name ?></h4>
			<hr>
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
//untuk load data table ajax	
var table;

$(document).ready(function() {

    //datatables
    table = $('#dataTable').DataTable({

        "processing": true, //Feature control the processing indicator.
        "order": [], //Initial no order.
        oLanguage: {
            sProcessing: "<img src='<?php base_url(); ?>assets/admin/img/loading.gif' width='30px'>",
            "sEmptyTable": "The data is not on the server",
            "oPaginate": {
                "sPrevious": "Prev"
            }
        },

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url('list-item-material/').$id ?>",
            "type": "POST"

        },

        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [-1], //last column
            "orderable": false, //set not orderable
        }, ],

    });
});

function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}

// untuk simpan data
$('#form-add').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Item/prosesAddMaterial'); ?>',
            type: "post",
            enctype: "multipart/form-data",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function(data) {
            var result = jQuery.parseJSON(data);
            console.log(result);
            if (result.status == 'berhasil') {
                document.getElementById("form-add").reset();
                Swal.fire({
					title: "Data saved successfully!",
					text: "Click the Ok button to continue!",
					icon: "success",
					button: "Ok",
				}).then(function() {
					reload_table();
				});
            } else {
                $(".loading2").hide();
                $(".loading2").modal('hide');
                gagal();

            }
        })
    e.preventDefault();
});

$(document).on("click", ".hapus-detail", function() {
    var id = $(this).attr("data-id");
    Swal.fire({
        title: 'Delete data?',
        text: "Sure you will delete the data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: "<?php echo base_url('Item/delete_detail'); ?>",
                data: "id=" + id,
                success: function(data) {
                    $("tr[data-id='" + id + "']").fadeOut("fast",
                        function() {
                            $(this).remove();
                        });
                    hapus_berhasil();
                    reload_table();
                }
            });
        }
    })
});

function hapus_berhasil() {
    Swal.fire({
        title: "Deleted data successfully!",
        text: "Click the Ok button to continue!",
        icon: "success",
        button: "Ok",
    })
}
</script>
