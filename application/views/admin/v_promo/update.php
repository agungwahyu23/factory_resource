<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $promo->id ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                value="<?= $promo->name ?>">
                        </div>
                        <div class=" form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" autocomplete="off"
                                value="<?= $promo->title ?>">
                        </div>
                        <div class=" form-group">
                            <label for="code_referral">Code Referral</label>
                            <input type="text" class="form-control" name="code_referral" id="code_referral"
                                autocomplete="off" value="<?= $promo->code_referral ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_start">Date Start</label>
                                    <input type="date" class="form-control" name="date_start" id="date_start"
                                        value="<?= $promo->date_start ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_end">Date End</label>
                                    <input type="date" class="form-control" name="date_end" id="date_end"
                                        value="<?= $promo->date_end ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                autocomplete="off"> <?= $promo->name ?></textarea>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <label for="">Image</label>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
                                        <div id="slider">
                                            <img class="img-thumbnail" width="200px" height="200px"
                                                src="<?php echo base_url() ?>upload/promo/<?= $promo->image; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image" id="image"
                                                onchange="return validFile()" />
                                            <small class="label badge badge-pill badge-danger">( Max 1 MB )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="is_active">Status Active</label>
                                    <select name="is_active" id="is_active" class="form-control selek-status"
                                        aria-describedby="sizing-addon2">
                                        <option value="0" <?php if ($promo->is_active == 0) : echo "selected";
                                                            endif; ?>>Non Active</option>
                                        <option value="1" <?php if ($promo->is_active == 1) : echo "selected";
                                                            endif; ?>>Active</option>
                                    </select>
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

<script type="text/javascript">
// untuk select2 ajak pilih tipe
$(function() {
    $(".selek-status").select2({
        placeholder: " -- Select Status -- "
    });
});

$('#form-update').submit(function(e) {
    var data = $(this).serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
            // method: 'POST',
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Promo/prosesUpdate'); ?>',
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

<script type="text/javascript">
function validFile() {
    var fileInput = document.getElementById('image');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        swal("Warning", "Files must be .jpg /.jpeg /.png format", "warning");
        fileInput.value = '';
        return false;
    } else {
        //Image preview
        if (fileInput.files && fileInput.files[0].size > 2007200) {
            swal("Warning", "Files must be a maximum of 1 MB", "warning");
            fileInput.value = '';
            return false;
        } else if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('slider').innerHTML = '<img width="400px" heiht="300px"  src="' + e.target
                    .result + '"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>

<script>
function save_berhasil() {
    Swal.fire({
        title: "Data saved successfully!",
        text: "Click the Ok button to continue!",
        icon: "success",
        button: "Ok",
    }).then(function() {
        var link = '<?php echo base_url("promo.html") ?>';
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
