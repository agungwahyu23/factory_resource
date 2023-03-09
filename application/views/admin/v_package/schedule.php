<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-add" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $id_package->id ?>">

                        <!-- <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="day">Day</label>
                                    <select name="day" id="day" class="form-control selek-day" required
                                        aria-describedby="sizing-addon2">
                                        <option></option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start">Start</label>
                                    <input type="time" class="form-control" name="start" id="start" autocomplete="off"
                                        placeholder="Enter Start Time">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end">End</label>
                                    <input type="time" class="form-control" name="end" id="end" autocomplete="off"
                                        placeholder="Enter End Time">
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

    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>Package ID</th> -->
                                    <!-- <th>Day</th> -->
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Aksi</th>
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

</div>
<!-- /.container-fluid -->

<script type="text/javascript">
$(function() {
    $(".selek-day").select2({
        placeholder: " -- Select Day -- "
    });
});
$('#form-add').submit(function(e) {
    var data = $(this).serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
            // method: 'POST',
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Package/prosesAddSchedule'); ?>',
            type: "post",
            enctype: "multipart/form-data",
            // data: data,
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
        location.reload();
    });
}

function gagal() {
    swal({
        title: "Data failed to save!",
        text: "Click the Ok button to continue!",
        icon: "danger",
        button: "Ok",
        dangerMode: true,
    }).then(function() {
        location.reload();
    });
}
</script>

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
            "url": "<?php echo base_url('package-listschedule/').$id_package->id?>",
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

$(document).on("click", ".delete-schedule", function() {
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
                url: "<?php echo base_url('Package/deleteSchedule'); ?>",
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
        title: "Data berhasil dihapus!",
        text: "Klik tombol Ok untuk melanjutkan!",
        icon: "success",
        button: "Ok",
    }).then(function() {
        location.reload();
    });
}
</script>