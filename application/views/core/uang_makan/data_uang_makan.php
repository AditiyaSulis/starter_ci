<style>

	#payroll_component_table {
		width: 100% !important;
	}


	#payroll_component_table thead th,
	#payroll_component_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}



</style>


<div class="mt-6">
	<div class="row">
		<div class="col-2 col-md-2 mb-3">
			<label class="form-label">Product :</label>
			<select id="filterProduct" class="form-select form-select-sm">
				<option value="" selected>All</option>
				<?php foreach($products as $product): ?>
					<option value="<?=$product['id_product']?>"><?=$product['name_product']?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="table-responsive">
		<table id="payroll_component_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<?php $no = 1 ?>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Nama</th>
				<th>Uang Makan</th>
				<th>Izin</th>
				<th>Pot Izin</th>
				<th>Cuti</th>
				<th>Pot Cuti</th>
				<th>Absen</th>
				<th>Pot Absen</th>
				<th>Holiday</th>
				<th>Pot Holiday</th>
				<th>Total Potongan</th>
				<th>Total Uang makan</th>
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
	let product = '';

	const base_urls = $('meta[name="base_url"]').attr('content');

	$(document).ready(function(){
		let params = new URLSearchParams(window.location.search);
		data = Object.fromEntries(params.entries());
	});


	let params = new URLSearchParams(window.location.search);
	data =  {
		'product' :  product,
		'uang_makan' :  params.get('uang_makan'),
	}

	function callDT() {
		table = $('#payroll_component_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_uang_makan',
				type: 'POST',
				data: function(d) {
					d.product = $('#filterProduct').val();
					d.uang_makan = data.uang_makan;
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


