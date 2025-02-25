<?php
$status_leave = isset($_GET['status_leave']) ? $_GET['status_leave'] : 3;
?>


<main>
	<h1>Leave</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">

		<h4>Leave Summary</h4>
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

			<div class="col">
				<div class="card bg-body ">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?=$this_month?>">
												<?=$this_month?>
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
											<span class="text-success" data-category-id="<?=$this_year?>">
												<?=$this_year?>
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
		Add Leave
	</button>

	<ul class="nav nav-tabs mt-8">
		<li class="nav-item">
			<a class="nav-link  <?= ($status_leave == 3) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('absence/leave/su_leave_page?status_leave=3&is=1')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_leave == 1) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('absence/leave/su_leave_page?status_leave=1&is=1')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_leave == 2) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('absence/leave/su_leave_page?status_leave=2&is=1')?>">Approval</a>
		</li>
	</ul>


	<?php $this->load->view($view_data)?>
	<?php $this->load->view($view_components)?>

	<!-- Modal  Leave -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Leave</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/leave/su_add_leave') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Karyawan</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_employee" id="id_employee">
								<option selected>-pilih karyawan-</option>
								<?php foreach($employees as $emp):?>
								<option value="<?=$emp['id_employee'];?>"><?=$emp['name'];?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Input</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="input_at" autocomplete="off" class="form-control bg-transparent" readonly/>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Type</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="type" id="type_leave">
								<option selected>-pilih type-</option>
								<option value="1">Single Day</option>
								<option value="2">Multiple Day</option>
							</select>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Mulai Cuti</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="tgl_mulai" value="<?= date("Y-m-d") ?>" name="start_day" autocomplete="off" class="form-control bg-transparent" />
						</div>

						<div id="mulai-form" style="display: none;">
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Selesai Cuti</span>
							</div>
							<div class="fv-row mb-8">
								<input type="date" id="tgl_selesai"  name="end_day" autocomplete="off" class="form-control bg-transparent" />
							</div>

							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Total Hari</span>
							</div>
							<div class="fv-row mb-8">
								<input type="number" id="total_hari" name="total_days" class="form-control bg-transparent" readonly />
							</div>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Ajukan Cuti</span>
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
		document.addEventListener('DOMContentLoaded', function () {
			const typeSelect = document.getElementById('type_leave');
			const additionalForm = document.getElementById('mulai-form');
			const tglMulai = document.getElementById("tgl_mulai");
			const tglSelesai = document.getElementById("tgl_selesai");
			const totalHari = document.getElementById("total_hari");


			typeSelect.addEventListener('change', function () {
				if (this.value === '2') {
					additionalForm.style.display = 'block';
				} else {
					additionalForm.style.display = 'none';
					tglSelesai.value = tglMulai.value;
					totalHari.value = 1;
				}
			});

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

	</script>
</main>
