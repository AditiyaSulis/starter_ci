<style>

	#schedule_dayoff_table {
		width: 100% !important;
	}


	#schedule_dayoff_table thead th,
	#schedule_dayoff_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}


</style>


<div class="shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
	<div class="row">
		<div class="col-5 col-md-3 mb-3">
			<label class="form-label">Waktu :</label>
			<select id="filterSelect2" class="form-select form-select-sm">
				<option value="" >All</option>
				<option value="today" selected>Today</option>
				<option value="yesterday">Yesterday</option>
				<option value="this_week">This Week</option>
				<option value="last_week">Last Week</option>
				<option value="this_month">This Month</option>
				<option value="last_month">Last Month</option>
				<option value="this_year">This Year</option>
				<option value="last_year">Last Year</option>
				<option value="custom">Custom Range</option>
			</select>
		</div>
		<div class="col-5 col-md-2 mb-3">
			<label class="form-label">Product :</label>
			<select id="filterProduct2" class="form-select form-select-sm">
				<option value="" selected>All</option>
				<?php foreach($products as $product): ?>
					<option value="<?=$product['id_product']?>"><?=$product['name_product']?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-5 col-md-2 mb-3">
			<label class="form-label">Status :</label>
			<select id="filterStatus" class="form-select form-select-sm">
				<option value="" selected>All</option>
				<option value="5" >Izin</option>
				<option value="4" >Cuti</option>
				<option value="2" >Day Off</option>
			</select>
		</div>
	</div>

	<div style="overflow-x: auto; width: 100%;">
		<table id="schedule_dayoff_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Product</th>
				<th>Divisi</th>
				<th>Status</th>
				<th>Tanggal</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>


<!-- Modal  Custom Date -->
<div id="customDateModal2" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select Date Range</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form id="customDateForm2">
					<div class="mb-3">
						<label for="startDate2" class="form-label">Start Date</label>
						<input type="date" id="startDate2" name="start_date" class="form-control">
					</div>
					<div class="mb-3">
						<label for="endDate" class="form-label">End Date</label>
						<input type="date" id="endDate2" name="end_date" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="applyCustomDate2">Apply</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>


<script>
	let table2;
	let option2 = '';
	let product2 = '';
	let startDate2 = '';
	let endDate2 = '';
	let status = '';




	function callDT2() {
		const base_urla = $('meta[name="base_url"]').attr('content');
		table2 = $('#schedule_dayoff_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urla + 'core/core_data/data_schedule_dayoff',
				type: 'POST',
				data: function(d) {
					d.option2 = $('#filterSelect2').val();
					d.product2 = $('#filterProduct2').val();
					d.startDate2 = $('#startDate2').val();
					d.endDate2 = $('#endDate2').val();
					d.status = $('#filterStatus').val();
				}
			},
			dom: "<'row'<'col-sm-12 col-md-6 d-flex align-items-center'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>>" +
				"tr" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			columnDefs: [
				{ targets: "_all", orderable: false },
				{ targets: 0, className: "text-center" },
				{ targets: [1, 2, 3, 4], responsivePriority: 1 },
				{ targets: -1, responsivePriority: 2 },
			]
		});
		$('#filterSelect2').on('change', function() {
			option2 = $(this).val();
			if (option2 === 'custom') {
				$('#customDateModal2').modal('show');
			} else {
				table2.ajax.reload();
			}
		})

		$('#applyCustomDate2').on('click', function() {
			startDate2 = $('#startDate2').val();
			endDate2 = $('#endDate2').val();

			if (!startDate2 || !endDate2) {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: "Masukan tanggal dengan benar"
				});
				return;
			}

			$('#customDateModal2').modal('hide');
			table2.ajax.reload();
		});

		$('#filterProduct2').change(function() {
			product2 = $('#filterProduct2').val();

			table2.ajax.reload();
		});
		$('#filterStatus').change(function() {
			status = $('#filterStatus').val();

			table2.ajax.reload();
		});

	}


	callDT2();






</script>

