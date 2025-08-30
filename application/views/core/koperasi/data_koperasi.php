<style>

	#koperasi_table {
		width: 100% !important;
	}


	#koperasi_table thead th,
	#koperasi_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}



</style>

<div class="   shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
	<div class="row g-3 align-items-center mt-4">
		<div class="col-4 col-md-2">
			<label class="form-label">Type Piutang :</label>
			<select id="filter-type-koperasi" class="form-select form-select-sm">
				<option value="All" selected>All</option>
				<option value="2">Kasbon</option>
				<option value="1">Pinjaman</option>
			</select>
		</div>
		<div class="col-4 col-md-2">
			<label class="form-label">Pelunasan :</label>
			<select id="filter-tenor-koperasi" class="form-select form-select-sm">
				<option value="All" selected>All</option>
				<option value="this_month">This month</option>
				<option value="next_month">Next month</option>
			</select>
		</div>
	</div>


	<div class="mt-6">
		<div class="table-responsive">
			<table id="koperasi_table" class="table table-bordered table-striped border-primary w-100" style="width:100%">
				<thead class="table-primary">
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Product</th>
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
</div>


<script>
	let data_koperasi = null;
	const base_urls = $('meta[name="base_url"]').attr('content');

	let tenor_koperasi = 'All';
	let type_koperasi = 'All';

	$(document).ready(function(){
		let params = new URLSearchParams(window.location.search);
		data_koperasi = Object.fromEntries(params.entries());
	});

	let params = new URLSearchParams(window.location.search);
	data_koperasi =  {
		'type_koperasi' :  $('#filter-type-koperasi').val(),
		'tgl_lunas' :  $('#filter-tenor-koperasi').val(),
		'status' :  params.get('status'),
		'with_alerts' :  params.get('with_alerts'),
	}

	function dtKoperasi() {
		var table = $('#koperasi_table').DataTable({
			responsive:{
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/Core_data/data_koperasi',
				type: 'POST',
				data: function (d) {
					type  = $('#filter-type').val();
					tenor  = $('#filter-tenor').val();
					d.type_koperasi = type_koperasi;
					d.tgl_lunas = tenor_koperasi;
					d.with_alerts = data_koperasi.with_alerts;
					d.status = data_koperasi.status;
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
			],

		});

		$('#filter-tenor-koperasi').change(function () {
			table.ajax.reload();
		});
		$('#filter-type-koperasi').change(function () {
			table.ajax.reload();
		});
	}

	console.log(data_koperasi);
	dtKoperasi()

</script>



