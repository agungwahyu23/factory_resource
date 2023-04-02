
    <div style="padding: 15px;">
        <h3 style="margin-top: 0;"><b>Laporan PDF Plus Filter Periode Tanggal</b></h3>
        <hr />
        <form method="get" action="<?php echo base_url('index.php/transaksi/index') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label>Filter Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                            <span class="input-group-addon">s/d</span>
                            <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>
            <?php
            if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                echo '<a href="'.base_url('index.php/transaksi/index').'" class="btn btn-default">RESET</a>';
            ?>
        </form>
        <hr />
        <h4 style="margin-bottom: 5px;"><b>Data Transaksi</b></h4>
        <?php echo $label ?><br />
        <div style="margin-top: 5px;">
            <a href="<?php echo $url_cetak ?>">CETAK PDF</a>
        </div>
        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(empty($transaksi)){ // Jika data tidak ada
                        echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                    }else{ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        foreach($transaksi as $data){ // Looping hasil data transaksi
                            $tgl = date('d-m-Y', strtotime($data->date_order)); // Ubah format tanggal jadi dd-mm-yyyy
                            echo "<tr>";
                            echo "<td>".$tgl."</td>";
                            echo "<td>".$data->code."</td>";
                            echo "<td>".$data->status."</td>";
                            echo "<td>".$data->status."</td>";
                            echo "<td>".$data->status."</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
    $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
    </script>
    <script>
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