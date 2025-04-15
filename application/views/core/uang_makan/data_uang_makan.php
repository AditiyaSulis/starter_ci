<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<!-- Buttons Styling -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

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
		<div class="col-2 col-md-2">
			<div id="custom-button-container" class="col-12 col-md-auto mt-5">
				<button id="exportPdf" type="button" class="btn btn-info btn-sm rounded-pill mt-3">
					<i class="ti ti-download"></i> Export to PDF
				</button>
			</div>
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
				<th>Bonus</th>
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
		'code' :  params.get('code'),
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
					d.code = data.code;
				}
			},
			dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
			buttons: [
				{
					extend: 'pdfHtml5',
					text: 'Export PDF',
					className: 'btn btn-danger',
					title: 'Uang Makan Report',
					orientation: 'portrait',
					pageSize: 'A4',
					exportOptions: {
						columns: [1, 2, 3,5,7, 9,11,12,13,14] // Sesuaikan dengan kolom yang ingin diekspor
					},
					customize: function(doc) {
						doc.defaultStyle.fontSize = 9;
						doc.styles.tableHeader.fontSize = 10;
						doc.pageMargins = [20, 30, 20, 30];

						// Cek apakah ada tabel sebelum mengaksesnya
						if (!doc.content || doc.content.length < 2 || !doc.content[1].table) {
							return;
						}

						// Format tabel dengan garis
						doc.content[1].layout = {
							hLineWidth: function(i, node) { return 0.8; },
							vLineWidth: function(i, node) { return 0.8; },
							hLineColor: function(i, node) { return '#000000'; },
							vLineColor: function(i, node) { return '#000000'; },
							paddingTop: function(i, node) { return 6; },
							paddingBottom: function(i, node) { return 6; }
						};

						// Hitung total uang makan
						let totalUangMakan = table
							.column(14, { page: 'all' }) // Kolom 13 adalah 'total_uang_makan'
							.data()
							.reduce(function(a, b) {
								let numA = parseFloat(a.toString().replace(/[^0-9,-]+/g, "").replace(",", "."));
								let numB = parseFloat(b.toString().replace(/[^0-9,-]+/g, "").replace(",", "."));
								return (numA || 0) + (numB || 0);
							}, 0);

						totalUangMakan = totalUangMakan.toLocaleString('id-ID');

						// Pastikan jumlah kolom sudah sesuai
						let columnCount = doc.content[1].table.body[0].length;

						// Row Total Uang Makan
						let totalRow = Array(columnCount).fill({ text: '', border: [false, false, false, false] });
						totalRow[0] = { text: 'TOTAL', colSpan: columnCount - 1, alignment: 'center', bold: true, margin: [0, 5, 0, 5] };
						totalRow[columnCount - 1] = { text: 'Rp ' + totalUangMakan, bold: true, alignment: 'right', margin: [0, 5, 0, 5] };

						// Pastikan tabel memiliki isi sebelum menambahkan total row
						if (doc.content[1].table.body.length > 1) {
							doc.content[1].table.body.push(totalRow);
						}

						doc.content.push({
							columns: [
								{
									width: '50%',
									text: '\n\n\nMengetahui,\nHRD',
									alignment: 'center',
									margin: [20, 40, 0, 0],
								},
								{
									width: '50%',
									text: '\n\n\nDibuat oleh,\nBagian Keuangan',
									alignment: 'center',
									margin: [0, 40, 80, 0],
								}
							]
						});
						doc.content.push({
							columns: [
								{
									width: '50%',
									text: '\n\n( Ara Suhara Sudrajat S.H )',
									alignment: 'center',
									margin: [20, 40, 0, 0],
								},
								{
									width: '50%',
									text: '\n\n( Amelia Gita Rahayu	 )',
									alignment: 'center',
									margin: [0, 40, 80, 0],
								}
							]
						});

					}
				}
			],
			columnDefs: [
				{ targets: "_all", orderable: false },
				{ targets: 0, className: "text-center" },
				{ targets: [1, 2, 3, 4], responsivePriority: 1 },
				{ targets: -1, responsivePriority: 2 },
			]
		});

		$('#filterProduct').change(function() {
			product = $('#filterProduct').val();
			table.ajax.reload();
		});
	}


	$('#exportPdf').on('click', function() {
		table.button('.buttons-pdf').trigger();
	});


	callDT();



</script>


