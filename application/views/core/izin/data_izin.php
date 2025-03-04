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


<div class="mt-6">
	<div class="col-3 col-md-1 mb-3">
		<label class="form-label">Tanggal Izin:</label>
		<select id="filterSelect" class="form-select form-select-sm">
			<option value="" selected>All</option>
			<option value="today">Today</option>
			<option value="tomorrow">Tomorrow</option>
			<option value="this_week">This Week</option>
			<option value="next_week">Next Week</option>
			<option value="this_month">This Month</option>
			<option value="next_month">Next Month</option>
			<option value="this_year">This Year</option>
			<option value="next_year">Next Year</option>
			<option value="custom">Custom Range</option>
		</select>
	</div>
	<div style="overflow-x: auto; width: 100%;">
		<table id="izin_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<?php $no = 1 ?>
			<tr>
				<th>No</th>
				<th>Tanggal Input</th>
				<th>Nama</th>
				<th>Produk</th>
				<th>Divisi</th>
				<th>Tanggal Izin</th>
				<th>Alasan</th>
				<th>Bukti</th>
				<th>Status</th>
				<th>Deskripsi</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>


<script>
	let table;
	let option = '';
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
		'startDate' :  startDate,
		'endDate' :  endDate,
		'employee' : employee,
		'status_izin' :  params.get('status_izin'),
		'with_alerts' :  params.get('with_alerts'),
	}

	function callDT() {
		table = $('#izin_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_izin',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.employee = data.employee;
					d.status_izin = data.status_izin;
					d.with_alerts = data.with_alerts;
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
		$('#filterSelect').on('change', function() {
			option = $(this).val();
			if (option === 'custom') {
				$('#customDateModal').modal('show');
			} else {
				table.ajax.reload();

			}


		});
	}



	callDT();



</script>

