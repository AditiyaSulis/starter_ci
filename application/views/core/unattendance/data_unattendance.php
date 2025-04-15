<style>

	#unattendance_table {
		width: 100% !important;
	}


	#unattendance_table thead th,
	#unattendance_table tbody td {
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
			<select id="filterSelect1" class="form-select form-select-sm">
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
			<select id="filterProduct1" class="form-select form-select-sm">
				<option value="" selected>All</option>
				<?php foreach($products as $product): ?>
					<option value="<?=$product['id_product']?>"><?=$product['name_product']?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div style="overflow-x: auto; width: 100%;">
		<table id="unattendance_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Product</th>
				<th>Shift</th>
				<th>Clock In</th>
				<th>Tanggal</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>


<!-- Modal  Custom Date -->
<div id="customDateModal1" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select Date Range</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form id="customDateForm1">
					<div class="mb-3">
						<label for="startDate1" class="form-label">Start Date</label>
						<input type="date" id="startDate1" name="start_date" class="form-control">
					</div>
					<div class="mb-3">
						<label for="endDate" class="form-label">End Date</label>
						<input type="date" id="endDate1" name="end_date" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="applyCustomDate1">Apply</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>


<script>
	let table1;
	let option1 = '';
	let product1 = '';
	let startDate1 = '';
	let endDate1 = '';


	function callDT1() {
		const base_urla = $('meta[name="base_url"]').attr('content');
		table1 = $('#unattendance_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urla + 'core/core_data/data_unattendance',
				type: 'POST',
				data: function(d) {
					d.option1 = $('#filterSelect1').val();
					d.product1 = $('#filterProduct1').val();
					d.startDate1 = $('#startDate1').val();
					d.endDate1 = $('#endDate1').val();
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
		$('#filterSelect1').on('change', function() {
			option1 = $(this).val();
			if (option1 === 'custom') {
				$('#customDateModal1').modal('show');
			} else {
				table1.ajax.reload();
			}
		})

		$('#applyCustomDate1').on('click', function() {
			startDate1 = $('#startDate1').val();
			endDate1 = $('#endDate1').val();

			if (!startDate1 || !endDate1) {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: "Masukan tanggal dengan benar"
				});
				return;
			}

			$('#customDateModal1').modal('hide');
			table1.ajax.reload();
		});

		$('#filterProduct1').change(function() {
			product1 = $('#filterProduct1').val();

			table1.ajax.reload();
		});

	}




	callDT1();






</script>

