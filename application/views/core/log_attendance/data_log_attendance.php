<style>

	#log_attendance_table {
		width: 100% !important;
	}


	#log_attendance_table thead th,
	#log_attendance_table tbody td {
		white-space: nowrap;
		padding: 5px;
	}


	div.dataTables_scrollHeadInner {
		width: 100% !important;
	}


</style>

<div class="mt-6">
	<div class="row">
		<div class="col-3 col-md-2 mb-3">
			<label class="form-label">Waktu :</label>
			<select id="filterSelect" class="form-select form-select-sm">
				<option value="today" selected>Today</option>
				<option value="yesterday">Yesterday</option>
				<option value="this_week">This Week</option>
				<option value="last_week">Last Week</option>
				<option value="this_month">This Month</option>
				<option value="last_month">Last Month</option>
				<option value="this_year">This Year</option>
				<option value="last_year">Last Year</option>
				<option value="custom">Custom Range</option>
			</select>
		</div>
		<div class="col-3 col-md-2 mb-3">
			<label class="form-label">Kehadiran :</label>
			<select id="filterTimeManagement" class="form-select form-select-sm">
				<option value="all" selected>All</option>
				<option value="on_time">On time</option>
				<option value="telat_masuk">Telat masuk</option>
			</select>
		</div>
		<?php if($employee == '' || empty($employee) ): ?>
		<div class="col-sm-4 col-md-2 mb-3">
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
		<table id="log_attendance_table" class="table table-bordered table-striped" style="width:100%">
			<thead class="table-primary">
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Product</th>
				<th>Shift</th>
				<th>Clock In</th>
				<th>Absen Dilakukan</th>
				<th>Kehadiran</th>
				<th>Potongan</th>
				<th>Tanggal Absen</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<!-- Modal  Custom Date -->
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


<div class="modal fade" tabindex="-1" id="potonganTelatModal">
	<div class="modal-dialog modal-dialog-centered modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Potongan Telat</h4>


				<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
				</div>

			</div>

			<div class="modal-body">
				<form class="form w-100" id="potonganTelatForm" enctype="multipart/form-data">
					<input type="hidden" id="id_attendance" name="id_attendance">
					<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
						<span>Potongan</span>
					</div>
					<div class="fv-row mb-8">
						<input type="number" id="potongan_telat" name="potongan_telat" class="form-control bg-transparent" />
					</div>

					<div class="d-grid mb-10">
						<button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Save
                                            </span>
							<span class="indicator-progress">
                                                     Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	let table;
	let option = '';
	let product = '';
	let startDate = '';
	let endDate = '';
	let timeManagement = 'all';
	let employee = '<?= $employee;?>';
	const base_urls = $('meta[name="base_url"]').attr('content');



	function callDT() {
		table = $('#log_attendance_table').DataTable({
			responsive: {
				details: {
					type: 'column',
					target: 'tr',
				}
			},
			processing: true,
			serverSide: true,
			ajax: {
				url: base_urls + 'core/core_data/data_log_attendance',
				type: 'POST',
				data: function(d) {
					d.option = $('#filterSelect').val();
					d.product = $('#filterProduct').val();
					d.startDate = $('#startDate').val();
					d.endDate = $('#endDate').val();
					d.timeManagement = $('#filterTimeManagement').val();
					d.employee = <?= $employee?>;
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
		})

		$('#applyCustomDate').on('click', function() {
			startDate = $('#startDate').val();
			endDate = $('#endDate').val();
			 employee = '<?= $employee;?>';

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
			employee = '<?= $employee;?>';
			table.ajax.reload();
		});

		$('#filterTimeManagement').change(function() {
			timeManagement = $('#filterTimeManagement').val();
			employee = '<?= $employee;?>';
			table.ajax.reload();
		});
	}


	function setPotonganTelat(element) {
		let $element = $(element);

		$("#id_attendance").val($element.data('id_attendance'));
		$("#potongan_telat").val($element.data('potongan_telat'));

		$("#potonganTelatModal").modal("show");
	}
	$(document).ready(function() {
		const base_url = $('meta[name="base_url"]').attr('content');

		$("#potonganTelatForm").on("submit", function(e) {
			e.preventDefault();
			$.ajax({
				url: base_url + "absence/attendance/set_potongan_telat",
				type: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function(response) {
					if (response.status) {
						Swal.fire({
							icon: "success",
							title: "Berhasil",
							text: response.message,
							timer: 1500,
							showConfirmButton: false
						}).then(() => location.reload());
					} else {
						Swal.fire({
							icon: "error",
							title: "Gagal",
							text: response.message
						});
					}
				},
				error: function(xhr, status, error) {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: "Terjadi kesalahan, silahkan coba lagi."
					});
				}
			});
		});
	});

	callDT();



</script>

