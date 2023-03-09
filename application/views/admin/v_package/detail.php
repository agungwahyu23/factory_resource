<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-update" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="chef_id">Chef</label>
                            <input type="text" class="form-control" readonly value="<?= $package->name ?>">
                        </div>
                        <div class="form-group">
                            <label for="package_code">Package Code</label>
                            <input type="text" class="form-control" readonly value="<?= $package->package_code ?>">
                        </div>
                        <div class=" form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" readonly value="<?= $package->slug ?>">
                        </div>
                        <div class=" form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" readonly value="<?= $package->title ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <br>
                            <?= $package->description ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="is_recomended">Status Recomended</label>
                                </div>
                                <div class="col-md-12">
                                    <?php if ($package->is_recomended == 0) {
                                        echo '<span class=" badge bg-danger text-white">No Recomended</span>';
                                    }else{
                                    echo '<span class="badge bg-success text-white">Recomended</span>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="term_policy">Term Policy</label>
                            <textarea class="form-control" readonly><?= $package->term_policy?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hour_duration">Hour Duration</label>
                                    <input type="time" class="form-control" readonly
                                        value="<?= $package->hour_duration ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minute_duration">Minute Duration</label>
                                    <input type="time" class="form-control" readonly
                                        value="<?= $package->minute_duration ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo">Seo</label>
                            <input type="text" class="form-control" readonly value="<?= $package->seo ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" readonly value="<?= $package->price ?>">
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
                                                src="<?php echo base_url() ?>upload/package/<?= $package->thumbnail; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
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