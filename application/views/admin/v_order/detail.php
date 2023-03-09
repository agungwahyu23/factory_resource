<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Package ID</label>
                            <input type="text" class="form-control" readonly value="<?= $order->package_id ?>">
                        </div>
                        <div class=" form-group">
                            <label>Name Promo</label>
                            <input type="text" class="form-control" readonly value="<?= $order->namapromo ?>">
                        </div>
                        <div class=" form-group">
                            <label>Name Order</label>
                            <input type="text" class="form-control" readonly value="<?= $order->namaorder ?>">
                        </div>
                        <div class=" form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" readonly value="<?= $order->email ?>">
                        </div>
                        <div class=" form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" readonly value="<?= $order->phone ?>">
                        </div>
                        <div class=" form-group">
                            <label>Street</label>
                            <input type="text" class="form-control" readonly value="<?= $order->street ?>">
                        </div>
                        <div class=" form-group">
                            <label>Floor No</label>
                            <input type="text" class="form-control" readonly value="<?= $order->floor_no ?>">
                        </div>
                        <div class=" form-group">
                            <label>City</label>
                            <input type="text" class="form-control" readonly value="<?= $order->city ?>">
                        </div>
                        <div class=" form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" readonly value="<?= $order->email ?>">
                        </div>
                        <div class=" form-group">
                            <label>State</label>
                            <input type="text" class="form-control" readonly value="<?= $order->state ?>">
                        </div>
                        <div class=" form-group">
                            <label>Number Of Adult</label>
                            <input type="number" class="form-control" readonly value="<?= $order->number_of_adult ?>">
                        </div>
                        <div class=" form-group">
                            <label>Number Of Kids</label>
                            <input type="number" class="form-control" readonly value="<?= $order->number_of_kids ?>">
                        </div>
                        <div class=" form-group">
                            <label>Note</label>
                            <textarea class="form-control" readonly><?= $order->note ?></textarea>
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