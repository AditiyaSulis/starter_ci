<?php
	$status_overtime = isset($_GET['status_overtime']) ? $_GET['status_overtime'] : 3;
?>


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

	<ul class="nav nav-tabs mt-8 ms-5">
		<li class="nav-item">
			<a class="nav-link <?= ($status_overtime == 3) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('absence/overtime/overtime_page?status_overtime=3&is=3')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_overtime == 1) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('absence/overtime/overtime_page?status_overtime=1&is=3')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_overtime == 2) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('absence/overtime/overtime_page?status_overtime=2&is=3')?>">Approval</a>
		</li>
	</ul>

	<?php $this->load->view($view_data); ?>
	<?php $this->load->view($view_components); ?>

	<!-- Modal  Overtime -->
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
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/overtime/add_overtime') ?>" enctype="multipart/form-data">
						<input type="hidden" value="<?= $user['email']?>" name="id_employee" autocomplete="off" class="form-control bg-transparent"/>
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
							<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Mulai Lembur (Jam)</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" id="start_overtime" name="start" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Selesai Lembur (Jam)</span>
						</div>
						<div class="fv-row mb-8">
							<input type="time" id="end_overtime" name="end" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Total Jam</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="total_hours" name="time_spend" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Ajukan Lembur</span>
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




	<script>

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
