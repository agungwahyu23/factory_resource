<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-detail" method="POST" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $item->id ?>">
						<div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" id="code" value="<?= $item->code ?>" autocomplete="off" readonly
                                placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off"
                                placeholder="Enter Item Name" value="<?= $item->name ?>" readonly>
                        </div>
                        <div class=" form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" autocomplete="off"
                                placeholder="Enter Item Price" value="<?= $item->price ?>" readonly>
                        </div>
                        <div class=" form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock" autocomplete="off"
                                placeholder="Enter Item Stock" value="<?= $item->stock ?>" readonly>
                        </div>
                        <div class=" form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit" id="unit" autocomplete="off"
                                placeholder="Enter Unit Item" value="<?= $item->unit ?>" readonly>
                        </div>
                        <div class=" form-group">
                            <label for="warehouse_id">Warehouse</label>
                            <input type="text" class="form-control" name="warehouse_id" id="warehouse_id" autocomplete="off"
                                placeholder="Enter warehouse" value="<?= $item->warehouse_id ?>" readonly>
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
