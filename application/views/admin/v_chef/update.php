<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $chef->id ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                value="<?= $chef->name ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off"
                                value="<?= $chef->email ?>">
                        </div>
                        <div class=" form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" autocomplete="off"
                                value="<?= $chef->phone ?>">
                        </div>
                        <div class=" form-group">
                            <?php
                            if ($chef->gender==0){
                                $female="checked";
                                $male="";
                            }elseif ($chef->gender==1) {
                                $male="checked";
                                $female="";
                            }
                            ?>
                            <label for="gender">Gender</label>
                            <br>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" <?= $male; ?> name="gender"
                                        value="1">Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" <?= $female; ?>
                                        value="0">Female
                                </label>
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

<script type="text/javascript">
$('#form-update').submit(function(e) {
    var data = $(this).serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
            // method: 'POST',
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Chef/prosesUpdate'); ?>',
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
        var link = '<?php echo base_url("chef.html") ?>';
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