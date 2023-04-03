<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- card untuk tambah data -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Return
                </div>
                <div class="card-body">
                <div class="row">
                		<div class="col-6">
                			<div class="form-group">
                				<label for="code">Code</label>
                				<input type="text" class="form-control" name="no_return" id="code" value="<?= $return->no_return ?>"
                					autocomplete="off" readonly placeholder="Enter Name">
                			</div>
                		</div>
                		<div class="col-6">
                			<div class="form-group">
                				<label for="name">Date Order</label>
                				<input type="text" class="form-control" name="date_return" id="date_order"
                					autocomplete="off" placeholder="Enter Item Name" value="<?= $return->date_return ?>"
                					readonly>
                			</div>
                		</div>
                		<div class="col-6">
                			<div class="form-group">
                				<label for="name">Status</label>
                				<input type="text" class="form-control" name="" id="" autocomplete="off"
                					placeholder="Enter Item Name"
                					value="<?php 
                                    $status = $return->status;
                                    if ($status == 0) {
                                        echo "Submitted";
                                    }elseif ($status == 1) {
                                        echo "Accept";
                                    }elseif ($status == 2) {
                                        echo "Reject";
                                    }else{
                                        echo "-";
                                    }
                                    ?>" readonly>
                			</div>
                		</div>
                		<div class="col-6">
                			<div class="form-group">
                				<label for="name">Note</label>
                				<input type="text" class="form-control" name="note" id="type" autocomplete="off" value="<?= $return->note ?>" readonly
                					placeholder="Enter Notes">
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir card -->

    <div class="row mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Detail Item
				</div>
				<div class="card-body">
					<div class="datatable table-responsive mt-2">
						<table id="detail_material_table" class="table table-striped table-bordered dt-responsive nowrap"
							cellspacing="0" style="width:100%">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Return Amount</th>
									<th class="text-center">Note</th>
								</tr>
							</thead>
							<tbody id="detail_material">
                            <?php 
								$i = 1; 
								if (isset($detail)) {
									foreach ($detail as $key => $value) {?>
										<tr>
											<td>
												<input type="text" class="form-control " name="material_name[]" type="text" value="<?= $value->name ?>" readonly>
											</td>

											<td>
												<input type="text" class="form-control " name="return_amount" type="text" value="<?= $value->return_amount ?>" readonly>
											</td>
											<td>
												<input type="text" class="form-control " name="information" type="text" value="<?= $value->information ?>" readonly>
											</td>
										</tr>	
									<?php $i++; } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">
                        <a href="javascript:history.go(-1)" class="btn btn-danger" type="submit" name="submit"><i
                                class="fas fa-chevron-left"></i> Back
                        </a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
