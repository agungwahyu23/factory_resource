<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $material->id ?>">
						<div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" id="code" value="<?= $material->code ?>" autocomplete="off" readonly
                                placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                placeholder="Enter Item Name" value="<?= $material->name ?>">
                        </div>
						<div class=" form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit" id="unit" autocomplete="off"
                                placeholder="Enter Unit Item" value="<?= $material->unit ?>">
                        </div>
                        <div class=" form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" autocomplete="off"
                                placeholder="Enter Item Price" value="<?= $material->price ?>">
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

<script type="text/javascript">
$('#form-update').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Material/prosesUpdate'); ?>',
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
        var link = '<?php echo base_url("material") ?>';
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
