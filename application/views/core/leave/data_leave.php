<style>

	#leave_table {
		width: 100% !important;
	}


	#leave_table thead th,
	#leave_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}



</style>

<div class="mt-6">
	<div class="row">
		<div class="col-3 col-md-1 mb-3">
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
		<?php if($employee == 'false') :?>
			<div class="col-3 col-md-1 mb-3">
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
	<div style="overflow-x: auto; width: 100%;">
		<table id="leave_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<?php $no = 1 ?>
			<tr>
				<th>No</th>
				<th>Tanggal Input</th>
				<th>Nama</th>
				<th>Produk</th>
				<th>Divisi</th>
				<th>Type</th>
				<th>Total Hari</th>
				<th>Mulai Cuti</th>
				<th>Selesai Cuti</th>
				<th>Deskripsi</th>
				<th>Status</th>
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
	let product = '';
	let employee = '<?= $employee;?>';
	const base_urls = $('meta[name="base_url"]').attr('content');

	$(document).ready(function(){
		let params = new URLSearchParams(window.location.search);
		data = Object.fromEntries(params.entries());
	});


	let params = new URLSearchParams(window.location.search);
	data =  {
		'status_leave' :  params.get('status_leave'),
		'with_alerts' :  params.get('with_alerts'),
		'is' :  params.get('is'),
	}


	function callDT() {
		table = $('#leave_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_leave',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.employee = <?= $employee?>;
					d.product = $('#filterProduct').val();
					d.status_leave = data.status_leave;
					d.with_alerts = data.with_alerts;
					d.is = data.is;
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

