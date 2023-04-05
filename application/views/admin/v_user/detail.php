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
                            <input type="text" class="form-control" value="<?= $user->code_employee ?>" name="code_employee" id="code_employee" autocomplete="off"
                                placeholder="Code Employee" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="name_of_employee">Name</label>
                            <input type="text" class="form-control" name="name_of_employee" id="name_of_employee" autocomplete="off"
                                placeholder="Enter Name" value="<?= $user->name_of_employee ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Telp</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" autocomplete="off"
                                placeholder="Enter Telp" value="<?= $user->no_telp ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label for="part_of">Part Of</label>
							<input type="text" class="form-control" name="no_telp" id="no_telp" autocomplete="off"
                                placeholder="Part Of" value="<?= $user->part_of ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" name="company" id="company" autocomplete="off"
                                placeholder="Enter company" value="<?= $user->company ?>"readonly>
                        </div>
						<div class="form-group">
                            <label for="status">Status</label>
							<input type="text" class="form-control" name="company" id="company" readonly autocomplete="off"
                                placeholder="Enter company" value="<?php 
								if ($user->company == 1) {
									echo "Active";
								}else{
									echo "Nonactive";
								}
								?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username*</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off"
                                placeholder="Enter Username" value="<?= $user->username ?>" readonly>
                        </div>
						<div class="form-group">
                            <label for="level">Level</label>
							<input type="text" class="form-control" name="company" id="company" readonly autocomplete="off"
                                placeholder="Enter company" value="<?php 
								if ($user->level == 0) {
									echo "Employee";
								}elseif ($user->level == 1) {
									echo "Admin Production";
								}elseif ($user->level == 2){
									echo "Admin Warehouse";
								}else{
									echo "Head Office";
								}
								?>">
                        </div>
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
</script>
