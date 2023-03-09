<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Please add data
                </div>
                <div class="card-body">
                    <form id="form-add" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="chef_id">Chef</label>
                            <select name="chef_id" id="chef_id" class="form-control selek-chef">
                                <option></option>
                                <?php foreach ($chef as $j) { ?>
                                <option value="<?= $j->id ?>">
                                    <?= $j->name ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="package_code">Package Code</label>
                            <input type="text" class="form-control" name="package_code" id="package_code"
                                autocomplete="off" placeholder="Enter Package Code">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" autocomplete="off"
                                placeholder="Enter Slug">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" autocomplete="off"
                                placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="editor1">Description</label>
                            <textarea name="description" id="editor1" class="form-control" autocomplete="off"
                                placeholder="Enter Description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="is_recomended">Status Recomended</label>
                                    <select name="is_recomended" id="is_recomended" class="form-control selek-status"
                                        required aria-describedby="sizing-addon2">
                                        <option>
                                        </option>
                                        <option value="0">
                                            No Recomended
                                        </option>
                                        <option value="1">
                                            Recomended
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="term_policy">Term Policy</label>
                            <textarea name="term_policy" id="term_policy" class="form-control" autocomplete="off"
                                placeholder="Enter Term Policy"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hour_duration">Hour Duration</label>
                                    <input type="time" class="form-control" name="hour_duration" id="hour_duration"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minute_duration">Minute Duration</label>
                                    <input type="time" class="form-control" name="minute_duration" id="minute_duration"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo">Seo</label>
                            <input type="text" class="form-control" name="seo" id="seo" autocomplete="off"
                                placeholder="Enter Seo">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" autocomplete="off"
                                placeholder="Enter Price">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <label for="">Thumbnail</label>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
                                        <div id="slider">
                                            <img class="img-thumbnail" width="200px" height="200px"
                                                src="<?php echo base_url(); ?>/assets/admin/img/no-image.png"
                                                alt="your image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="thumbnail" id="thumbnail"
                                                onchange="return validFile()" />
                                            <small class="label badge badge-pill badge-danger">( Max 1 MB )</small>
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

<!-- panggil ckeditor.js -->
<script src="<?= base_url('assets/admin/vendor/ckeditor/ckeditor.js'); ?>"></script>
<!-- panggil adapter jquery ckeditor -->
<script src="<?= base_url('assets/admin/vendor/ckeditor/adapters/jquery.js'); ?>"></script>
<script type="text/javascript">
// untuk select2 ajak pilih tipe
$(function() {
    $(".selek-status").select2({
        placeholder: " -- Select Status -- "
    });
});
// untuk select2 ajak pilih chef
$(function() {
    $(".selek-chef").select2({
        placeholder: " -- Select Chef -- "
    });
});

CKEDITOR.replace('editor1', {
    filebrowserBrowseUrl: '/fileman/index.html', // Öntanımlı Dosya Yöneticisi
    filebrowserImageBrowseUrl: '/fileman/index.html?type=image', // Sadece Resim Dosyalarını Gösteren Dosya Yöneticisi
    removeDialogTabs: 'link:upload;image:upload' // Upload işlermlerini dosya Yöneticisi ile yapacağımız için upload butonlarını kaldırıyoruz
});
$('#form-add').submit(function(e) {
    CKEDITOR.instances['editor1'].updateElement(); //CKEditor  bilgileri  aktarıyor.
    var data = $(this).serializeArray();
    // var data = $(this).serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
            // method: 'POST',
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Package/prosesAdd'); ?>',
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

<script type="text/javascript">
function validFile() {
    var fileInput = document.getElementById('thumbnail');
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
        var link = '<?php echo base_url("admin-package.html") ?>';
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