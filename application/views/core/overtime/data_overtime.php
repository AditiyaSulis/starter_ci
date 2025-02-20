<div class="mt-6">
	<div class="col-2 col-md-2 mb-3">
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
	<table id="overtime_table" class="table table-bordered table-striped" style="width:100%">
		<thead>
		<?php $no = 1 ?>
		<tr>
			<th>No</th>
			<th>Tanggal Input</th>
			<th>Nama</th>
			<th>Produk</th>
			<th>Divisi</th>
			<th>Tanggal Lembur</th>
			<th>Mulai</th>
			<th>Selesai</th>
			<th>Total Jam</th>
			<th>Upah</th>
			<th>Status</th>
			<th>Deskripsi</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
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
		'status_overtime' :  params.get('status_overtime'),
		'with_alerts' :  params.get('with_alerts'),
		'is' :  params.get('is'),
	}

	function callDT() {
		table = $('#overtime_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_overtime',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.employee = data.employee;
					d.status_overtime = data.status_overtime;
					d.with_alerts = data.with_alerts;
					d.is = data.is;
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


		});
	}



	callDT();



</script>

