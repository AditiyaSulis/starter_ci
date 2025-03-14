<?php
$status_overtime = isset($_GET['status_overtime']) ? $_GET['status_overtime'] : 3;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<style>
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th, td {
		border: 1px solid #ddd;
		text-align: center;
		padding: 10px;
	}
	th {
		background: #f4f4f4;
	}
	.event {
		padding: 5px;
		border-radius: 5px;
		font-weight: bold;
	}
	.calendar { width: 100%; border-collapse: collapse; }
	.calendar th, .calendar td { padding: 10px; text-align: center; border: 1px solid #ddd; }
	.calendar-header { background-color: #f4f4f4; }
	.week-days td { font-weight: bold; background-color: #efefef; }
	.today { background-color: rgba(35, 70, 248, 0.2) !important; font-weight: bold; }
	.jadwal { background-color: #adf6bc; }
	.dayoff { background-color: #ed6f6f; }
	.tanggal_merah { background-color: #d50e0e; }
	.cuti { background-color: #e4df65; }
	.izin { background-color: #65c2e4; }
	.absen { background-color: #e87828; }
	.minggu { background-color: rgba(209, 35, 248, 0.2); }
	.nothing { background-color: #73736b;


</style>
<main>
	<h1>Schedule</h1>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Schedule
	</button>

	<div class="row g-3 align-items-center mt-4">
		<div class="col-4 col-md-2">
			<label class="form-label">Product:</label>
			<select id="filter-product" class="form-select form-select-sm">
				<option value="All" selected>All</option>
				<?php foreach($products as $product):?>
					<option value="<?= $product['id_product']?>"><?= $product['name_product']?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>

	<div class="mt-6">
		<table id="employees_table" class="table table-bordered table-striped border-primary" style="width:100%">
			<thead>
			<?php $no = 1 ?>
			<tr>
				<th>No</th>
				<th>NIP</th>
				<th>Name</th>
				<th>Produk</th>
				<th>Divisi</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>


	<!-- Modal  Add Schedule -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Schedule</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/schedule/add_batch_schedule') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Product</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_product" id="id_product">
								<option selected>-pilih product-</option>
								<?php foreach($products as $product):?>
									<option value="<?=$product['id_product'];?>"><?=$product['name_product'];?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Division</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_division" id="id_division">
								<option selected>-pilih divisi-</option>
								<?php foreach($divisions as $division):?>
									<option value="<?=$division['id_division'];?>"><?=$division['name_division'];?></option>
								<?php endforeach;?>
							</select>
						</div>
<!--						<div class="fv-row mb-8">-->
<!--							<select class="form-select select2-employees" name="id_employee[]" id="id_employee" multiple>-->
<!--							</select>-->
<!--						</div>-->
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Karyawan</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_employee[]" id="id_employee" multiple>

							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Shift</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_workshift" id="id_workshift">
								<option selected>-pilih shift-</option>
								<?php foreach($workshifts as $shift): ?>
									<?php
									$clockIn = new DateTime($shift['clock_in']);
									$clockOut = new DateTime($shift['clock_out']);
									?>
									<option value="<?=$shift['id_workshift'];?>">
										<?=$shift['name_workshift'];?> ( <?=$clockIn->format("H:i");?> - <?=$clockOut->format("H:i");?> )
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Mulai</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="start_date" value="<?= date("Y-m-d") ?>" name="start_date" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Selesai</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="end_date"  name="end_date" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Total Hari</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="total"  name="total" autocomplete="off" class="form-control bg-transparent" readonly />
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Add Schedule</span>
								<span class="indicator-progress">
									Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
							</button>
						</div>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Jadwal Employee-->
	<div class="modal fade" id="showScheduleModal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Schedule</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div style="overflow-x: auto;">
						<div id="calendar-container">
							<p>Loading schedule...</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Riwayat Kehadiran -->
	<div class="modal fade" id="riwayatKehadiranModal" tabindex="-1" aria-labelledby="riwayatKehadiranLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Data Riwayat Kehadiran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-2 col-md-2">
							<span>Nama</span>
						</div>
						<div class="col-8 col-md-8">
							<span id="name_karyawan"></span>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-2 col-md-2">
							<span>Product</span>
						</div>
						<div class="col-8 col-md-8">
							<span id="name_product"></span>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-2 col-md-2">
							<span>Division</span>
						</div>
						<div class="col-8 col-md-8">
							<span id="name_division"></span>
						</div>
					</div>
					<h5 class="mt-12">Bulan Ini:</h5>
					<div class="mt-3 p-3 rounded" style="background-color: #f0f0f0;">
						<div class="row">
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-tidak-hadir>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Tidak Hadir</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-izin>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Izin</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-dayoff>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Day Off</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-cuti>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Cuti</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<h5 class="mt-4">Tahun Ini:</h5>
					<div class="mt-3 p-3 rounded" style="background-color: #f0f0f0;">
						<div class="row">
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-tidak-hadir-year>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Tidak Hadir</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-izin-year>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Izin</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-dayoff-year>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Day Off</div>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card bg-body shadow-lg">
									<div class="card-body text-center">
										<div class="fs-2 fw-bolder text-success" data-riwayat-cuti-year>0</div>
										<div class="fw-bold text-gray-800" style="font-size: 12px;">Cuti</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Status Schedule -->
	<div class="modal fade" tabindex="-1" id="setStatusScheduleModal">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Set Status Schedule</h4>


					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
					</div>

				</div>

				<div class="modal-body">
					<form class="form w-100" id="setStatusScheduleForm" enctype="multipart/form-data">
						<input type="hidden" id="id_schedule_set" name="id_schedule">
						<input type="hidden" id="id_employee_set" name="id_employee">
						<input type="hidden" id="clock_in_set" name="clock_in">
						<input type="hidden" id="old_status_set" name="old_status">
						<input type="hidden" id="waktu_set" name="waktu">
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" id="status_set" name="status">
								<option value="6">Hadir</option>
								<option value="7">Absen</option>
								<option value="10">Hapus Jadwal</option>
							</select>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Save changes
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
		const base_url = $('meta[name="base_url"]').attr('content');

		function callDT()
		{
			var table = $('#employees_table').DataTable({
				responsive:{
					details: {
						type: 'column',
						target: 'tr',
					}
				},
				processing: true,
				serverSide: true,
				ajax: {
					url: base_url + 'absence/schedule/dtSideServer',
					type: 'POST',
					data: function(d) {
						product = $('#filter-product').val();
						d.product = product;
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

			$('#filter-product').change(function() {
				table.ajax.reload();
			});
		}

		callDT();

		let selectedEmployeesMap = new Map();

		$('#id_division, #id_product').on('change', function () {
			const divisionId = $('#id_division').val();
			const productId = $('#id_product').val();
			const employeeSelect = $('#id_employee');

			if (!productId || productId === "-pilih product-") {
				console.log("⏳ Pilih product terlebih dahulu.");
				return;
			}

			let key = divisionId ? `${productId}_${divisionId}` : `${productId}`;

			let previousSelection = employeeSelect.val() || [];
			if (previousSelection.length > 0) {
				selectedEmployeesMap.set(key, previousSelection);
			}

			getEmployee(productId, divisionId, key);
		});

		function getEmployee(productId, divisionId, key) {
			$.ajax({
				url: base_url + 'absence/schedule/option_employee',
				type: 'POST',
				data: { id_product: productId, id_division: divisionId },
				dataType: 'json',
				success: function (response) {
					const employeeSelect = $('#id_employee');
					let previousSelection = selectedEmployeesMap.get(key) || [];
					let existingOptions = employeeSelect.find('option:selected').map(function () {
						return this.value;
					}).get(); // Ambil opsi yang sudah dipilih sebelumnya

					let newSelection = [...existingOptions]; // Simpan opsi yang sudah dipilih sebelumnya

					if (response.status) {
						let availableEmployees = response.data.map(emp => emp.id_employee.toString());

						// 🔹 Hapus hanya opsi yang tidak dipilih sebelumnya
						employeeSelect.find('option').each(function () {
							let empId = this.value;
							if (!existingOptions.includes(empId)) {
								$(this).remove();
							}
						});

						$.each(response.data, function (index, employee) {
							let empId = employee.id_employee.toString();
							let isSelected = existingOptions.includes(empId);

							if (isSelected || previousSelection.includes(empId)) {
								newSelection.push(empId);
							}

							if (employeeSelect.find(`option[value="${empId}"]`).length === 0) {
								employeeSelect.append(
									`<option value="${empId}" ${isSelected ? "selected" : ""}>${employee.name}</option>`
								);
							}
						});

						newSelection = [...new Set(newSelection)]; // Hapus duplikasi

						setTimeout(() => {
							employeeSelect.val(newSelection).trigger('change');
							selectedEmployeesMap.set(key, newSelection);
						}, 100);
					} else {
						console.log("⚠️ Tidak ada data employee baru.");
						// 🚀 Jika tidak ada data baru, hapus semua kecuali yang sudah dipilih
						employeeSelect.find('option').each(function () {
							let empId = this.value;
							if (!previousSelection.includes(empId)) {
								$(this).remove();
							}
						});

						setTimeout(() => {
							employeeSelect.val(previousSelection).trigger('change');
						}, 100);
					}
				},
				error: function (xhr, status, error) {
					console.error('❌ Error AJAX:', error, xhr.responseText);
				}
			});
		}

		$(document).ready(function () {
			$('#id_employee').select2({
				placeholder: "Select options",
				width: '100%'
			});
		});

		document.addEventListener('DOMContentLoaded', function () {

			const tglMulai = document.getElementById("start_date");
			const tglSelesai = document.getElementById("end_date");
			const totalHari = document.getElementById("total");

			tglSelesai.addEventListener("input", function() {
				const startDate = new Date(tglMulai.value);
				const endDate = new Date(tglSelesai.value);

				if (startDate && endDate && endDate >= startDate) {
					const diffTime = endDate.getTime() - startDate.getTime();
					const diffDays = Math.ceil(diffTime / (1000 * 3600 * 24)) + 1;
					totalHari.value = diffDays;
				} else {
					totalHari.value = 0;
				}
			});
		})

		// Show Schedule
		function showSchedule(id_employee) {
			$("#showScheduleModal").modal("show");

			// Ambil tahun dan bulan saat ini
			let currentDate = new Date();
			let year = currentDate.getFullYear();
			let month = currentDate.getMonth() + 1; // Karena getMonth() mulai dari 0

			loadCalendar(id_employee, year, month);
		}


		function loadCalendar(id_employee, year, month) {
			$.ajax({
				url: base_url + `absence/schedule/load_calendar_by_ajax/${year}/${month}`,
				type: 'GET',
				data: { id_employee: id_employee },
				dataType: 'json',
				beforeSend: function () {
					$("#calendar-container").html('<p>Loading schedule...</p>'); // Indikator loading
				},
				success: function(response) {
					if (response.status) {
						$("#calendar-container").html(response.calendar);
						updateCalendarNavigation(id_employee); // Perbarui navigasi kalender
					} else {
						$("#calendar-container").html('<p class="text-danger">Gagal memuat jadwal.</p>');
					}
				},
				error: function(xhr, status, error) {
					console.error('Error AJAX:', error, xhr.responseText);
					$("#calendar-container").html('<p class="text-danger">Terjadi kesalahan saat mengambil data.</p>');
				}
			});
		}


		function updateCalendarNavigation(id_employee) {
			$(".calendar-header a").each(function() {
				let url = $(this).attr("href");
				let match = url.match(/(\d{4})\/(\d{1,2})/); // Ambil year dan month dari URL

				if (match) {
					let newYear = match[1];
					let newMonth = match[2];

					$(this).off("click").on("click", function(e) {
						e.preventDefault();
						loadCalendar(id_employee, newYear, newMonth);
					});
				}
			});
		}


		$(document).on("click", "#calendar-container .calendar-header a", function(e) {
			e.preventDefault();
			let url = $(this).attr("href");
			let match = url.match(/(\d{4})\/(\d{1,2})/);

			if (match) {
				let newYear = match[1];
				let newMonth = match[2];
				let id_employee = $("#showScheduleModal").data("id_employee");

				loadCalendar(id_employee, newYear, newMonth);
			}
		});


		//RIWAYAT KEHADIRAN
		const riwayatModal = document.getElementById('riwayatKehadiranModal');
		riwayatModal.addEventListener('show.bs.modal', function (event) {
			const button = event.relatedTarget;
			const employeeId = button.getAttribute('data-id-employee');
			const name_karyawan = button.getAttribute('data-name-karyawan');
			const name_product = button.getAttribute('data-name-product');
			const name_division = button.getAttribute('data-name-division');

			console.log("🔍 Mengambil data riwayat untuk ID:", employeeId);

			$('#name_karyawan').text(': '+name_karyawan);
			$('#name_product').text(': '+name_product);
			$('#name_division').text(': '+name_division);



			$.ajax({
				url: base_url + "absence/schedule/riwayat_kehadiran",
				type: "POST",
				data: { id_employee: employeeId },
				dataType: "json",
				success: function (response) {
					if (response.status) {
						console.log("✅ Data riwayat diterima:", response);

						document.querySelector("[data-riwayat-tidak-hadir]").textContent = response.thisMonth.absen || 0;
						document.querySelector("[data-riwayat-izin]").textContent = response.thisMonth.izin || 0;
						document.querySelector("[data-riwayat-dayoff]").textContent = response.thisMonth.dayoff || 0;
						document.querySelector("[data-riwayat-cuti]").textContent = response.thisMonth.cuti || 0;

						document.querySelector("[data-riwayat-tidak-hadir-year]").textContent = response.thisYear.absen || 0;
						document.querySelector("[data-riwayat-izin-year]").textContent = response.thisYear.izin || 0;
						document.querySelector("[data-riwayat-dayoff-year]").textContent = response.thisYear.dayoff || 0;
						document.querySelector("[data-riwayat-cuti-year]").textContent = response.thisYear.cuti || 0;
					} else {
						console.log("⚠️ Data tidak ditemukan:", response.message);
						resetRiwayatData();
					}
				},
				error: function (xhr, status, error) {
					console.error("❌ Error AJAX:", error, xhr.responseText);
					resetRiwayatData();
				}
			});

			function resetRiwayatData() {
				document.querySelector("[data-riwayat-tidak-hadir]").textContent = "0";
				document.querySelector("[data-riwayat-izin]").textContent = "0";
				document.querySelector("[data-riwayat-dayoff]").textContent = "0";
				document.querySelector("[data-riwayat-cuti]").textContent = "0";
				document.querySelector("[data-riwayat-tidak-hadir-year]").textContent = "0";
				document.querySelector("[data-riwayat-izin-year]").textContent = "0";
				document.querySelector("[data-riwayat-dayoff-year]").textContent = "0";
				document.querySelector("[data-riwayat-cuti-year]").textContent = "0";
			}
		});

		//SET SCHEDULE
		const setStatusScheduleModal = document.getElementById('setStatusScheduleModal');
		setStatusScheduleModal.addEventListener('show.bs.modal', function (event) {
			// console.log("Related Target:", event.relatedTarget);

			const button = event.relatedTarget;
			const id_schedule = button.getAttribute('data-id_schedule');
			const id_employee = button.getAttribute('data-id_employee');
			const status = button.getAttribute('data-status');
			const clock_in = button.getAttribute('data-clock_in');
			const waktu = button.getAttribute('data-waktu');

			console.log("ID:", id_schedule);

			$('#id_employee_set').val(id_employee);
			$('#id_schedule_set').val(id_schedule);
			$('#status_set').val(status);
			$('#clock_in_set').val(clock_in);
			$('#waktu_set').val(waktu);
			$('#old_status_set').val(status);

			$("#setStatusScheduleForm").on("submit", function (e) {
				e.preventDefault();

				Swal.fire({
					title: 'Apakah Anda yakin?',
					text: "Pastikan data yang dimasukan sudah benar",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Update',
					cancelButtonText: 'Batal',
				}).then((result) => {
					if (result.isConfirmed) {

						$.ajax({
							url: base_url + "absence/schedule/set_status_schedule",
							type: "POST",
							data: $(this).serialize(),
							dataType: "json",
							success: function (response) {
								if (response.status) {
									swallMssg_s(response.message, false, 1500)
										.then(() => {
											location.reload();
										});
								} else {
									swallMssg_e(response.message, true, 0);
									// submitButton.prop("disabled", false).text("Submit");
								}
							},
							error: function (xhr, status, error) {
								swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
									.then(() => {
										location.reload();
									});
								// submitButton.prop("disabled", false).text("Submit");
							}
						});
					}
				});
			});

		});

	</script>
</main>
