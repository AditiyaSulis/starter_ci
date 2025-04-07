<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<style>

	#holyday_table {
		width: 100% !important;
	}


	#holyday_table thead th,
	#holyday_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}



</style>

<div class="mt-6">
	<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
		<div class="row">
			<div class="col-3 col-md-2 col-lg-1 mb-3">
				<label class="form-label">Waktu :</label>
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
			<div class="col-3 col-md-2 col-lg-1 mb-3">
				<label class="form-label">Product :</label>
				<select id="filterProduct" class="form-select form-select-sm">
					<option value="" selected>All</option>
					<?php foreach($products as $product): ?>
						<option value="<?=$product['id_product']?>"><?=$product['name_product']?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-5 col-md-4 mb-3 mt-8">
				<button type="button" class="btn gradient-btn-delete rounded-pill btn-sm" data-bs-toggle="modal" data-bs-target="#deleteByCodeModal">
					<i class="bi bi-trash"></i>
					Delete By Code
				</button>
			</div>
		</div>

		<div style="overflow-x: auto; width: 100%;">
			<table id="holyday_table" class="table table-bordered table-striped" style="width:100%">
				<thead class="table-primary">
				<?php $no = 1 ?>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Product</th>
					<th>Divisi</th>
					<th>Select type</th>
					<th>Jenis Libur</th>
					<th>Tanggal Libur</th>
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
	let table;
	let option = '';
	let product = '';
	let startDate = '';
	let endDate = '';
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
	}

	function callDT() {
		table = $('#holyday_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_holyday',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.product = $('#filterProduct').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
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

		$('#filterProduct').change(function() {
			product = $('#filterProduct').val();
			table.ajax.reload();
		});
	}



	callDT();



</script>

