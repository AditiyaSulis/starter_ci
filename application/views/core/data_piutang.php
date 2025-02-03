<div class="row g-3 align-items-center mt-4">
	<div class="col-12 col-md-auto">
		<label class="form-label">Type Piutang :</label>
		<select id="filter-type" class="form-select form-select-sm">
			<option value="All" selected>All</option>
			<option value="2">Kasbon</option>
			<option value="1">Pinjaman</option>
		</select>
	</div>
	<div class="col-12 col-md-auto">
		<label class="form-label">Pelunasan :</label>
		<select id="filter-tenor" class="form-select form-select-sm">
			<option value="All" selected>All</option>
			<option value="this_month">This month</option>
			<option value="next_month">Next month</option>
		</select>
	</div>
</div>

<div class="mt-6">
	<div class="table-responsive">
		<table id="piutang_table" class="table table-bordered table-striped border-primary w-100" style="width:100%">
			<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Karyawan</th>
				<th>Type</th>
				<th>Tenor</th>
				<th>Jatuh Tempo</th>
				<th>Tgl Lunas</th>
				<th>Amount</th>
				<th>Remaining</th>
				<th>Status</th>
				<th>Angsuran</th>
				<th>Description</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<script>
	let data = null;
	const base_urls = $('meta[name="base_url"]').attr('content');


	$(document).ready(function(){
		let params = new URLSearchParams(window.location.search);
		data = Object.fromEntries(params.entries());
	});

	let params = new URLSearchParams(window.location.search);
		data =  {
			'type_piutang' :  $('#filter-type').val(),
			'tgl_lunas' :  $('#filter-tenor').val(),
			'status_piutang' :  params.get('status_piutang'),
			'with_alerts' :  params.get('with_alerts'),
		}

	// $('#jatuhtempo_table').DataTable({
	// 	responsive: true,
	// 	scrollX: true,
	// 	autoWidth: false,
	// 	columnDefs: [
	// 		{ width: '150px', targets: [2, 3, 4, 5] },
	// 		{ className: "text-nowrap", targets: "_all" }
	// 	]
	// });

	function dtPiutang() {
		var table = $('#piutang_table').DataTable({
			responsive:{
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_piutang',
				type: 'POST',
				data: function (d) {
					type = data.type_piutang;
					tenor = data.tgl_lunas;
					d.type_piutang = type;
					d.tgl_lunas = tenor;
					d.with_alerts = data.with_alerts;
					d.status_piutang = data.status_piutang;
				}
			},
			columnDefs: [
				{ targets: "_all", orderable: false },
				{ targets: 0, className: "text-center" },
				{ targets: [1, 2, 3, 4], responsivePriority: 1 },
				{ targets: -1, responsivePriority: 2 },
			],

		});

		$('#filter-tenor').change(function () {
			table.ajax.reload();
		});
		$('#filter-type').change(function () {
			table.ajax.reload();
		});
	}

	console.log(data);
	dtPiutang()
</script>
