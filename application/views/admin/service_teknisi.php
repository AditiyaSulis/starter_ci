<?php
$status_service_teknisi = isset($_GET['status_service_teknisi']) ? $_GET['status_service_teknisi'] : 3;
?>

<main>
	<h1>Record Service Teknisi</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">

		<h4> Summary</h4>
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

			<div class="col">
				<div class="card bg-body ">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?=$total_service_teknisi_this_month?>">
											<?=$total_service_teknisi_this_month?>
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
											<span class="text-success" data-category-id="<?=$total_service_teknisi?>">
											<?=$total_service_teknisi?>
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

	<ul class="nav nav-tabs mt-8">
		<li class="nav-item">
			<a class="nav-link <?= ($status_service_teknisi == 3) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('admin/service_teknisi/service_teknisi_page?status_service_teknisi=3&is=3')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_service_teknisi == 1) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('admin/service_teknisi/service_teknisi_page?status_service_teknisi=1&is=3')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_service_teknisi == 2) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('admin/service_teknisi/service_teknisi_page?status_service_teknisi=2&is=3')?>">Approval</a>
		</li>
	</ul>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Record
	</button>

	<?php $this->load->view($view_data);?>
	<?php $this->load->view($view_components);?>

	<!-- Modal  DayOff -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Service Record</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/service_teknisi/add_service_teknisi') ?>" enctype="multipart/form-data">
						<input type="hidden" value="<?= $user['email']; ?>" name="id_employee" autocomplete="off" class="form-control bg-transparent" />
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Service</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="tanggal_service" value="<?= date("Y-m-d") ?>" name="tanggal_service" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jenis Service</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="type_service" id="type_service">
								<option selected>-pilih jenis service-</option>
								<option value="Ganti baterai">Ganti baterai</option>
								<option value="Mati total">Mati total</option>
								<option value="Ganti LCD">Ganti LCD</option>
								<option value="Backdoor">Backdoor</option>
								<option value="Touchscreen">Touchscreen</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Pendapatan</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="pendapatan_service" name="pendapatan_service" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>

						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
									<span class="indicator-label">
										Add Service Record
									</span>
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

	</script>
</main>
