<style>

	#izin_table {
		width: 100% !important;
	}


	#izin_table thead th,
	#izin_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}


</style>


<div class="shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
	<div class="col-3 col-md-3 col-lg-3 mb-3">
		<label class="form-label">Tanggal :</label>
		<select id="filterSelect" class="form-select form-select-sm">
			<option value="" selected>All</option>
			<option value="today" >Today</option>
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
	<div style="overflow-x: auto; width: 100%;">
		<table id="riwayat_saldo_table"  class="table table-bordered  table-striped" style="width:100%">
			<thead class="table-primary">
			<tr>
				<th>Tanggal</th>
				<th>Keterangan</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
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
	let startDate = '';
	let endDate = '';
	let type_saldo = <?=$type?>;
	const base_urls = $('meta[name="base_url"]').attr('content');

	function callDT() {
		table = $('#riwayat_saldo_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'admin/Koperasi/riwayat_saldo_ssr',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.type_saldo = type_saldo;
				}
			},
			dom: "<'row'<'col-sm-12 col-md-6 d-flex align-items-center'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'f>>" +
				"tr" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			columnDefs: [
				{ targets: "_all", orderable: false },
				{ targets: 0, className: "text-center" },
				{ targets: [1], responsivePriority: 1 },
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


		});

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
			option = 'custom';
			table.ajax.reload();

		});

	}



	callDT();



</script>

