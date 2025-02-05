
<main>
	<h1>Overtime</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">

		<h4>Overtime Summary</h4>
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

			<div class="col">
				<div class="card bg-body ">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="S">
												3 Hours
											</span>
								</div>
								<div class="fw-bold text-gray-800">
									This Month</div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-calendar-week-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card bg-body ">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="">
												4 Hours
											</span>
								</div>
								<div class="fw-bold text-gray-800">
									This Year</div>
							</div>
							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-calendar-month-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Overtime
	</button>

	<div class="mt-8">
		<div class="col-2 col-md-2 mb-3">
			<label class="form-label">Filter Waktu:</label>
			<select id="filterSelect" class="form-select form-select-sm">
				<option value="" selected>All</option>
				<option value="today">Today</option>
				<option value="tommorow">Tomorrow</option>
				<option value="this_week">This Week</option>
				<option value="last_week">Last Week</option>
				<option value="this_month">This Month</option>
				<option value="last_month">Last Month</option>
				<option value="this_year">This Year</option>
				<option value="next_year">Last Year</option>
				<option value="custom">Custom Range</option>
			</select>
		</div>
		<table id="dayoff_table" class="table table-bordered table-striped" style="width:100%">
			<thead>
			<?php $no = 1 ?>
			<tr>
				<th>No</th>
				<th>Tanggal Input</th>
				<th>Nama</th>
				<th>Produk</th>
				<th>Divisi</th>
				<th>Tanggal Lembur</th>
				<th>Total Jam</th>
				<th>Mulai Lembur</th>
				<th>Selesai Lembur</th>
				<th>Deskripsi</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>

	<!-- Modal  Leave -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Overtime</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/piutang/add_piutang') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Input</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="input_at" autocomplete="off" class="form-control bg-transparent" readonly/>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Lembur</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="date_leave" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Mulai Lembur (Jam)</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" id="start_overtime" name="start_overtime" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Selesai Lembur (Jam)</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" id="end_overtime" name="end_overtime" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Total Jam</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="total_hours" name="total_hours" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Buat Lembur</span>
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

	<!-- Modal  Custom Date -->
	<div id="customDateModal" class="modal fade" tabindex="-1">
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
		const base_urls = $('meta[name="base_url"]').attr('content');

		$(document).ready(function(){
			let params = new URLSearchParams(window.location.search);
			data = Object.fromEntries(params.entries());
		});


		function callDT() {
			table = $('#purchases_table').DataTable({
				responsive: {
					details: {
						type: 'column',
						target: 'tr',
					}
				},
				processing: true,
				serverSide: true,
				ajax: {
					url: base_urls + 'core/core_data/data_purchases',
					type: 'POST',
					data: function(d) {
						d.option = option;
						d.startDate = startDate;
						d.endDate = endDate;
					}
				},
				columnDefs: [
					{ targets: "_all", orderable: false },
					{ targets: 0, className: "text-center" },
					{ targets: [1, 2, 3, 4], responsivePriority: 1 },
					{ targets: -1, responsivePriority: 2 },
				]
			});

		}


		callDT();

		// ---------- FILTER DATE
		$('#filterSelect').on('change', function() {
			option = $(this).val();

			if (option === 'custom') {
				$('#customDateModal').modal('show');
			} else {
				table.ajax.reload();

				updateCards(option)
			}


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
			option = 'custom';
			table.ajax.reload();
			updateCards(option, startDate, endDate);
		});


		//DELETE
		function handleDeletePurchaseButton(id) {
			console.log('id nya : '+id)
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Data yang dihapus tidak dapat dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, Hapus',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
					const base_url = $('meta[name="base_url"]').attr('content');
					$.ajax({
						url: base_url + 'admin/purchases/delete',
						type: 'POST',
						data: { id: id },
						success: function(response) {
							console.log(response);
							var res = JSON.parse(response);
							if (res.status) {
								swallMssg_s(res.message, true, 0)
									.then(() => {
										location.reload();
									});
							} else {
								swallMssg_e(res.message, true, 0);
							}
						},
						error: function(xhr, status, error) {
							Swal.fire(
								'Kesalahan!',
								'Terjadi kesalahan: Silakan coba lagi.',
								'error'
							);
						},
					});
				}
			});
		}

		//MULAI CUTI FORM
		document.addEventListener('DOMContentLoaded', function() {
			const startOvertime = document.getElementById('start_overtime');
			const endOvertime = document.getElementById('end_overtime');
			const totalHours = document.getElementById('total_hours');

			function calculateTotalHours() {
				const startTime = startOvertime.value;
				const endTime = endOvertime.value;

				if (startTime && endTime) {
					const start = new Date(`1970-01-01T${startTime}:00`);
					const end = new Date(`1970-01-01T${endTime}:00`);

					let diff = end - start;
					if (diff < 0) {
						// Jika waktu selesai lebih kecil dari waktu mulai, artinya lembur melewati tengah malam
						diff += 24 * 60 * 60 * 1000; // Tambahkan 24 jam
					}

					const hours = diff / (1000 * 60 * 60);
					totalHours.value = hours.toFixed(2); // Menampilkan total jam dengan 2 angka di belakang koma
				} else {
					totalHours.value = '';
				}
			}

			startOvertime.addEventListener('change', calculateTotalHours);
			endOvertime.addEventListener('change', calculateTotalHours);
		});

	</script>
</main>
