<script type="text/javascript">
	// define variable table
	var table;
	var table_modal;

	// define datatable is empty
	var count_list_material = '';
	<?php if (isset($detail)) { ?>
		count_list_material = '<?php echo count($detail) ?>';
	<?php }else{ ?>
		count_list_material = 0;
	<?php } ?>
	console.log(count_list_material);

	checkCountListMaterial();

	$(document).on("click",".choose_material",function(){
		count_list_material = count_list_material + 1;
		
		var id_material = $(this).attr("data-id");
        var material_name = $(this).attr("data-name");
        var material_price = $(this).attr("data-price");
		
		detail_material_html = `
            <tr id="list_detail_material` + count_list_material + `">
                <td>
					<input type="hidden" class="form-control" name="material_id[]" type="text" id="material_id` + count_list_material + `" value="`+id_material+`">
                    <input type="text" class="form-control" name="material_name[]" type="text" id="material_name` + count_list_material + `" value="`+material_name+`" readonly>
					<input type="hidden" class="form-control" name="material_price[]" type="text" id="material_price` + count_list_material + `" value="`+material_price+`">
                </td>
                <td>
                    <input type="text" class="form-control " name="qty_requested[]" type="text" id="qty_requested` + count_list_material + `">
                </td>
                <td style="text-align: center;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger btn-xs" onclick="removeDetailMaterial('material_detail` + count_list_material + `');">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        $('#detail_material').append(detail_material_html);

		$('#modal_material').modal('hide');

        checkCountListMaterial();
    });

	function removeDetailMaterial(id_row_detail_material = '') {
        count_list_material = count_list_material - 1;
		console.log('#'+id_row_detail_material);
        $('#'+id_row_detail_material).remove();
        checkCountListMaterial();
    }

	function checkCountListMaterial() {
        if (count_list_material == 0) {
            $('#detail_material').html(`
                <tr id="list_detail_material">
                    <td colspan="4" style="text-align: center">
                        Belum Ada Data
                    </td>
                </tr>
            `);
        } else {
            $('#list_detail_material').remove();
        }
    }

	$(document).ready(function() {
		// define datatable for modal
		table_modal = $('#modal_item').DataTable({
				"processing": true, //Feature control the processing indicator.
				"order": [], //Initial no order.
				oLanguage: {
				sProcessing: "<img src='<?php base_url();?>assets/tambahan/gambar/loading.gif' width='30px'>",
				"oPaginate": {
					"sPrevious": "Prev"
				},
				"sEmptyTable": "Data tidak ada di server"
					},

				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('Request/ajax_list_modal')?>",
					"type": "POST"
					
				},

				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ -1 ], //last column
					"orderable": false, //set not orderable
				},
				],
			});
	});

// process add data order
$('#form-add').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Request/prosesAdd'); ?>',
            type: "post",
            enctype: "multipart/form-data",
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
                Swal.fire({
					title: "Data saved successfully!",
					text: "Click the Ok button to continue!",
					icon: "success",
					button: "Ok",
				}).then(function() {
					var link = '<?php echo base_url("request/") ?>';
					window.location.replace(link);
				});
            } else {
                $(".loading2").hide();
                $(".loading2").modal('hide');
                gagal();

            }
        })
    e.preventDefault();
});

// process add data roadmap
$('#form-acc').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Request/prosesSend'); ?>',
            type: "post",
            enctype: "multipart/form-data",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function(data) {
            var result = jQuery.parseJSON(data);
            console.log(data);
            if (result.status == 'berhasil') {
                document.getElementById("form-acc").reset();
                Swal.fire({
					title: "Data saved successfully!",
					text: "Click the Ok button to continue!",
					icon: "success",
					button: "Ok",
				}).then(function() {
					var link = '<?php echo base_url("request/") ?>';
					window.location.replace(link);
				});
            } else {
                $(".loading2").hide();
                $(".loading2").modal('hide');
                gagal();

            }
        })
    e.preventDefault();
});

// process edit data order
$('#form-edit').submit(function(e) {
    var data = $(this).serialize();
    $.ajax({
            beforeSend: function() {
                $(".loading2").show();
                $(".loading2").modal('show');
            },
            url: '<?php echo base_url('Request/prosesUpdate'); ?>',
            type: "post",
            enctype: "multipart/form-data",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function(data) {
            var result = jQuery.parseJSON(data);
            console.log(data);
            if (result.status == 'berhasil') {
                document.getElementById("form-edit").reset();
                Swal.fire({
					title: "Data saved successfully!",
					text: "Click the Ok button to continue!",
					icon: "success",
					button: "Ok",
				}).then(function() {
					var link = '<?php echo base_url("request/") ?>';
					window.location.replace(link);
				});
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
