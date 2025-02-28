<style>

	#payroll_table {
		width: 100% !important;
	}


	#payroll_table thead th,
	#payroll_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}

</style>

<div class="mt-6">
	<div class="col-2 col-md-2 mb-3">
		<label class="form-label">Input At:</label>
		<select id="filterSelect" class="form-select form-select-sm">
			<option value="" selected>All</option>
			<option value="today">Today</option>
			<option value="tommorow">Tomorrow</option>
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
		<table id="payroll_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<?php $no = 1 ?>
			<tr>
				<th>No</th>
				<th>Tanggal Input</th>
				<th>Kode</th>
				<th>Potong Piutang</th>
				<th>Insert Finance Record</th>
				<th>Potong Libur Nasional</th>
				<th>Tanggal Gajian</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>


<script>
	let table1;
	let option = '';
	let startDate = '';
	let endDate = '';
	const baseur = $('meta[name="base_url"]').attr('content');

	$(document).ready(function(){
		let para = new URLSearchParams(window.location.search);
		data = Object.fromEntries(para.entries());
	});


	let para = new URLSearchParams(window.location.search);
	data =  {
		'option' :  option,
		'startDate' :  startDate,
		'endDate' :  endDate,
	}

	function callDT1() {
		table1 = $('#payroll_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: baseur + 'core/core_data/data_payroll',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.startDate = data.startDate;
					d.endDate = data.endDate;
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
	}


	callDT1();



</script>

