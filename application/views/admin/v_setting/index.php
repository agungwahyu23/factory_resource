<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title_header">Title Header</label>
                            <!-- <input type="text" class="form-control" name="title_header" id="title_header" autocomplete="off"
                                value="<?= $setting->title_header ?>" placeholder="Ex: Amazing Food Amazing Service"> -->
							<textarea name="title_header" class="form-control" id="title_header" autocomplete="off"
                                placeholder="Enter Description"><?= $setting->title_header ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="founding_date">Founding date</label>
                            <input type="text" class="form-control" name="founding_date" id="founding_date" autocomplete="off" placeholder="Ex: 2023"
                                value="<?= $setting->founding_date ?>">
                        </div>
                        <div class="form-group">
                            <label for="company_desc">Company Description</label>
                            <textarea name="company_desc" class="form-control" id="editor1" autocomplete="off"
                                placeholder="Enter Description"><?= $setting->company_desc ?></textarea>
                        </div>
						<div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" autocomplete="off" placeholder="Ex: Colorado, street no.11"
                                value="<?= $setting->address ?>">
                        </div>
						<div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="city" autocomplete="off" placeholder="Ex: Colorado"
                                value="<?= $setting->city ?>">
                        </div>
						<div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" id="state" autocomplete="off" placeholder="Ex: US"
                                value="<?= $setting->state ?>">
                        </div>
						<div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="Ex: gohibchi@gmail.com"
                                value="<?= $setting->email ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" placeholder="Ex: +6281234567890"
                                value="<?= $setting->phone ?>">
                        </div>
                        <div class="form-group">
                            <label for="wa">WhatsApp</label>
                            <input type="text" class="form-control" name="wa" id="wa" autocomplete="off" placeholder="Ex: +6281234567890"
                                value="<?= $setting->wa ?>">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram" autocomplete="off" placeholder="Your instagram link. Ex: https://www.instagram.com/your_username/"
                                value="<?= $setting->instagram ?>">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" name="facebook" id="facebook" autocomplete="off" placeholder="Your facebook link. Ex: https://web.facebook.com/your_username"
                                value="<?= $setting->facebook ?>">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" name="twitter" id="twitter" autocomplete="off" placeholder="Your Twitter link. Ex: https://twitter.com/your_username"
                                value="<?= $setting->twitter ?>">
                        </div>
                        <div class="form-group">
                            <label for="maps">Maps</label>
                            <input type="text" class="form-control" name="maps" id="maps" autocomplete="off" placeholder="Enter your link maps"
                                >
                        </div>
						<div class="form-group">
                            <label for="seo">Search Engine Optimization</label>
                            <textarea name="seo" class="form-control" autocomplete="off"
                                placeholder="Enter Description For SEO. Ex: Best Hibachi in colorado with best quality and best service. Choose your best place, let us bring food for you"><?= $setting->seo ?></textarea>
                        </div>
						<div class="form-group">
                            <label for="keyword">Keyword</label>
                            <input type="text" class="form-control" name="keyword" id="keyword" autocomplete="off" placeholder="Enter relevant and highly searched keywords. Ex: Hibachi, Colorado, Food, Japanese Hibachi, etc."
                                value="<?= $setting->keyword ?>">
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
CKEDITOR.replace('editor1', {
    filebrowserBrowseUrl: '/fileman/index.html', // Öntanımlı Dosya Yöneticisi
    filebrowserImageBrowseUrl: '/fileman/index.html?type=image', // Sadece Resim Dosyalarını Gösteren Dosya Yöneticisi
    removeDialogTabs: 'link:upload;image:upload' // Upload işlermlerini dosya Yöneticisi ile yapacağımız için upload butonlarını kaldırıyoruz
});

CKEDITOR.replace('title_header', {
    filebrowserBrowseUrl: '/fileman/index.html', // Öntanımlı Dosya Yöneticisi
    filebrowserImageBrowseUrl: '/fileman/index.html?type=image', // Sadece Resim Dosyalarını Gösteren Dosya Yöneticisi
    removeDialogTabs: 'link:upload;image:upload' // Upload işlermlerini dosya Yöneticisi ile yapacağımız için upload butonlarını kaldırıyoruz
});
</script>

<script type="text/javascript">
$('#form-update').submit(function(e) {
	CKEDITOR.instances['editor1','title_header'].updateElement();
    var data = $(this).serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
            // method: 'POST',
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Setting/prosesUpdate'); ?>',
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
        var link = '<?php echo base_url("setting.html") ?>';
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
