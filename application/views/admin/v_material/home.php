<!-- DataTales Example -->
<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
			<?php  
				if ($this->session->userdata('level') == 2) { ?>	
            		<a href="<?= site_url('material-add') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add Data</a>
			<?php } ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Price</th>
							<!-- cek session produksi atau gudang -->
							<?php  
							if ($this->session->userdata('level') == 2) { ?>
                            <th>Action</th>
							<?php } ?>
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
            "url": "<?php echo site_url('Material/ajax_list') ?>",
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

$(document).on("click", ".delete-material", function() {
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
                url: "<?php echo base_url('Material/delete'); ?>",
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
