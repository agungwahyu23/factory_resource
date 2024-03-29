<div class="col-xl-12 col-lg-12 col-md-12 mb-4">
<div class="accordion" id="accordionExample">
	<div class="card">
		<div class="card-header" id="headingOne">
			<h2 class="mb-0">
				<button class="btn btn-block text-left" type="button" data-toggle="collapse"
					data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Filter
				</button>
			</h2>
		</div>

		<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
			<div class="card-body">
				<form method="get" action="<?php echo base_url('Report/return') ?>">
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="form-group">
								<label>Filter Date</label>
								<div class="input-group">
									<input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>"
										class="form-control tgl_awal" placeholder="Start Date" autocomplete="off">
									<span class="input-group-addon">s/d</span>
									<input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>"
										class="form-control tgl_akhir" placeholder="End Date" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<button type="submit" name="filter" value="true" class="btn btn-primary">Show</button>
					<?php
                        if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                        echo '<a href="'.base_url('Report/index').'" class="btn btn-default">RESET</a>';
                    ?>
                <a class="btn btn-primary" target="_blank" href="<?php echo $url_cetak ?>">Print PDF</a>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- DataTales Example -->
<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
            DataTable
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        	<th>Date Order</th>
                        	<th>Transaction Code</th>
                        	<th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(empty($transaksi)){ // Jika data tidak ada
                        echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                    }else{ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        foreach($transaksi as $data){ // Looping hasil data transaksi
                            $tgl = date('d-m-Y', strtotime($data->date_return)); // Ubah format tanggal jadi dd-mm-yyyy
                            echo "<tr>";
                            echo "<td>".$tgl."</td>";
                            echo "<td>".$data->no_return."</td>";
                            echo "<td>".$data->tot."</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
     $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    });

    function setDateRangePicker(input1, input2) {
        	$(input1).datepicker({
        		autoclose: true,
        		format: "yyyy-mm-dd",
        	}).on("change", function () {
        		$(input2).val("").datepicker('setStartDate', $(this).val());
        	}).attr("readonly", "readonly").css({
        		"cursor": "pointer",
        		"background": "white"
        	});
        	$(input2).datepicker({
        		autoclose: true,
        		format: "yyyy-mm-dd",
        		orientation: "bottom right"
        	}).attr("readonly", "readonly").css({
        		"cursor": "pointer",
        		"background": "white"
        	});
        }
</script>
