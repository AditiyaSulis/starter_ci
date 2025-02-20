<div class="mt-6">
	<div class="row">
		<div class="col-2 col-md-2 mb-3">
			<label class="form-label">Waktu :</label>
			<select id="filterSelect" class="form-select form-select-sm">
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
		<?php if($employee == '' || empty($employee) ): ?>
		<div class="col-2 col-md-2 mb-3">
			<label class="form-label">Product :</label>
			<select id="filterProduct" class="form-select form-select-sm">
				<option value="" selected>All</option>
				<?php foreach($products as $product): ?>
					<option value="<?=$product['id_product']?>"><?=$product['name_product']?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php endif; ?>
	</div>

	<table id="log_attendance_table" class="table table-bordered table-striped" style="width:100%">
		<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Product</th>
			<th>Shift</th>
			<th>Clock In</th>
			<th>Absen Dilakukan</th>
			<th>Tanggal Absen</th>
		</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>

<!-- Modal  Custom Date -->
<div id="customDateModal" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select Date Range</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form id="customDateForm">
					<div class="mb-3">
						<label for="startDate" class="form-label">Start Date</label>
						<input type="date" id="startDate" name="start_date" class="form-control">
					</div>
					<div class="mb-3">
						<label for="endDate" class="form-label">End Date</label>
						<input type="date" id="endDate" name="end_date" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="applyCustomDate">Apply</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<script>
	let table;
	let option = '';
	let product = '';
	let startDate = '';
	let endDate = '';
	let employee = '<?= $employee;?>';
	const base_urls = $('meta[name="base_url"]').attr('content');

	$(document).ready(function(){
		let params = new URLSearchParams(window.location.search);
		data = Object.fromEntries(params.entries());
	});


	let params = new URLSearchParams(window.location.search);
	data =  {
		'option' :  option,
		'product' :  product,
		'startDate' :  startDate,
		'endDate' :  endDate,
		'employee' : employee,
		'product' : product,
	}

	function callDT() {
		table = $('#log_attendance_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_log_attendance',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.product = $('#filterProduct').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.employee = data.employee;
				}
			},
			columnDefs: [
				{ targets: "_all", orderable: false },
				{ targets: 0, className: "text-center" },
				{ targets: [1, 2, 3, 4], responsivePriority: 1 },
				{ targets: -1, responsivePriority: 2 },
			]
		});
		$('#filterSelect').on('change', function() {
			option = $(this).val();
			if (option === 'custom') {
				$('#customDateModal').modal('show');
			} else {
				table.ajax.reload();
			}
		})

		$('#applyCustomDate').on('click', function() {
			startDate = $('#startDate').val();
			endDate = $('#endDate').val();

			if (!startDate || !endDate) {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: "Masukan tanggal dengan benar"
				});
				return;
			}

			$('#customDateModal').modal('hide');
			table.ajax.reload();
		});

		$('#filterProduct').change(function() {
			product = $('#filterProduct').val();
			table.ajax.reload();
		});
	}



	callDT();



</script>

