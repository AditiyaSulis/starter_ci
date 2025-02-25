<style>
	#attendance_table {
		width: 100% !important;
		border-collapse: collapse;
	}

	#attendance_table th,
	#attendance_table td {
		border: 1px solid #ddd !important;
		padding: 8px;
		text-align: start;
	}

	#attendance_table thead {
		background-color: #65c2e4;
		color: white;
	}
</style>


<div class="mt-6">
	<div class="row mb-2">
			<div class="col-auto mb-2">
				<button type="button" class="btn btn-primary btn-sm  rounded-pill" data-bs-toggle="modal" data-bs-target="#customDateModal">
					Custom Date
				</button>
			</div>
		<?php if($employee == 'false'):?>
			<div class="col-2 col-md-2 mb-3">
				<select id="filterProduct" class="form-select form-select-sm">
					<option value="" selected>All Product</option>
					<?php foreach($products as $product): ?>
						<option value="<?=$product['id_product']?>"><?=$product['name_product']?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-auto mb-2">
				<button id="exportPDF" type="button" class="btn btn-info btn-sm rounded-pill">
					<i class="ti ti-download"></i> Export to PDF
				</button>
			</div>
		<?php endif; ?>
	</div>

	<table id="attendance_table" class="table table-bordered table-striped" style="width:100%">
		<thead>
		<?php $no = 1 ?>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Product</th>
			<th>Divisi</th>
			<th>Tidak Hadir</th>
			<th>Day Off</th>
			<th>Izin</th>
			<th>Cuti</th>
		</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>


<!-- Modal untuk Custom Date -->
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
	let product = '';
	let employee = '<?= $employee;?>';
	const base_urls = $('meta[name="base_url"]').attr('content');

	function formatDate(dateStr) {
		if (!dateStr) return '';
		let date = new Date(dateStr);
		let options = { day: '2-digit', month: 'short', year: 'numeric' };
		return date.toLocaleDateString('en-GB', options).replace(',', '');
	}

	function callDT() {
		table = $('#attendance_table').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_attendance',
				type: 'POST',
				data: function(d) {
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.product = $('#filterProduct').val();
					d.employee = <?= $employee?>;
				}
			},
			dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
			buttons: [
				{
					extend: 'pdfHtml5',
					text: 'Export PDF',
					className: 'btn btn-info btn-sm rounded-pill',
					pageSize: 'A4',
					orientation: 'portrait',
					title: function() {
						return 'Rekap Kehadiran';
					},

					customize: function(doc) {
						let startDate = formatDate($('#startDate').val());
						let endDate = formatDate($('#endDate').val());

						doc.content.splice(1, 0, {
							text: `Pada tanggal : ${startDate} sampai ${endDate}`,
							fontSize: 10,
							bold: true,
							margin: [0, 0, 0, 10]
						});

						doc.defaultStyle.fontSize = 9;

						let tableIndex = doc.content.findIndex(item => item.table);

						if (tableIndex !== -1) {
							doc.content[tableIndex].table.widths = ['5%', '20%', '20%', '15%', '10%', '10%', '10%', '10%'];

							doc.content[tableIndex].layout = {
								hLineWidth: function(i, node) { return 1; },
								vLineWidth: function(i, node) { return 1; },
								hLineColor: function(i, node) { return '#000'; },
								vLineColor: function(i, node) { return '#000'; },
								paddingLeft: function(i, node) { return 4; },
								paddingRight: function(i, node) { return 4; }
							};
						}

						doc.styles.tableHeader = {
							bold: true,
							fontSize: 8,
							color: 'white',
							fillColor: '#65c2e4',
							alignment: 'center'
						};

						doc.styles.title = {
							fontSize: 14,
							bold: true,
							alignment: 'center'
						};
					}

				}
			],
			columnDefs: [
				{ targets: "_all", orderable: false },
				{ targets: 0, className: "text-center" },
				{ targets: [1, 2, 3, 4], responsivePriority: 1 },
				{ targets: -1, responsivePriority: 2 }
			]
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
			table.ajax.reload();
		});

		$('#filterProduct').change(function() {
			product = $('#filterProduct').val();
			table.ajax.reload();
		});
	}


	$(document).ready(function() {


		$('#exportPDF').on('click', function () {
			table.button('.buttons-pdf').trigger();
		});
	});


	callDT();






</script>

