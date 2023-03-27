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
                            <label for="code_employee">Code</label>
                            <input type="text" class="form-control" value="<?= $code ?>" name="code_employee" id="code_employee" autocomplete="off"
                                placeholder="Code Employee" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="name_of_employee">Name*</label>
                            <input type="text" class="form-control" name="name_of_employee" id="name_of_employee" autocomplete="off"
                                placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Telp</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" autocomplete="off"
                                placeholder="Enter Telp">
                        </div>
                        <div class="form-group">
                            <label for="part_of">Part Of</label>
                           	<select name="part_of" id="part_of" class="form-control">
								<option value="PRODUKSI">Production</option>
								<option value="GUDANG">Warehouse</option>
							</select>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" name="company" id="company" autocomplete="off"
                                placeholder="Enter company">
                        </div>
						<div class="form-group">
                            <label for="status">Status</label>
                           	<select name="status" id="status" class="form-control">
								<option value="1">Active</option>
								<option value="0">Nonactive</option>
							</select>
                        </div>
                        <div class="form-group">
                            <label for="username">Username*</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off"
                                placeholder="Enter Username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" id="myInput"
                                placeholder="Enter Password" required>
                            <input type="checkbox" onclick="myFunction()">Show Password
                        </div>
						<div class="form-group">
                            <label for="level">Level*</label>
                           	<select name="level" id="level" class="form-control">
								<option value="0">Employee</option>
								<option value="1">Production</option>
								<option value="2">Warehouse</option>
							</select>
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
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

$('#form-add').submit(function(e) {
    var data = $(this).serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
            // method: 'POST',
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('User/prosesAdd'); ?>',
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
        var link = '<?php echo base_url("user") ?>';
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
