
<main>
    <?php if ($this->session->flashdata('authorize')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata('authorize'); ?>
    </div>
    <?php endif; ?>
    <h1>Dashboard</h1>

	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

					<div class="col">
						<div class="card bg-body ">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
										<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?= $allSuperUsers ?>">
												<?= $allSuperUsers ?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Super Users</div>
									</div>

									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-person-fill-gear" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
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
											<span class="text-success" data-category-id="<?= $allAdmins ?>">
												<?=$allAdmins?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Admins</div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-person-lines-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
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
										<span class="text-success" data-category-id="<?= $allUsers ?>">
											<?= $allUsers?>
										</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Users </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-people-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="col">
						<div class="card bg-body">
							<div class="card-body py-4 ">
								<div class="row">
									<div class="col-md-6">
									<div class="text-gray-900 fw-bolder fs-2">
										<span class="text-success" data-category-id="<?= $allProducts ?>">
											<?= $allProducts?>
										</span>
									</div>
									<div class="fw-bold text-gray-800">
										 Products </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-buildings-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
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
											<span class="text-success" data-category-id="<?= $allEmployees ?>">
												<?= $allEmployees?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											 Employees </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-person-badge-fill" style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
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
											<span class="text-success" data-category-id="<?= $allRecords ?>">
												<?= $allRecords?>
											</span>
										</div>
										<div class="fw-bold text-gray-800">
											Finance Records </div>
									</div>
									<div class="col-md-6  d-flex justify-content-center align-items-center">
										<h1><i class="bi bi-currency-exchange"` style="color:cornflowerblue; font-size: 3rem;" ></i></h1>
									</div>
								</div>
							</div>
						</div>
					</div>
		</div>
	</div>

	<!-- Card Piutang -->
	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
		<h3>Piutang</h3>
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

			<div class="col">
				<div class="card bg-body bg-light-warning bg-gradient">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
									<span class="text-success" data-category-id="<?= $totalJatuhTempo ?>">
										<?= $totalJatuhTempo ?>
									</span>

								</div>
								<div class="fw-bold text-gray-800">
									Tanggal <span class="text-danger" style="font-weight: bold"><?= date("d")?> - <?=date('d', strtotime('+3 days'))?> </span></div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-bell-fill" style="color:orangered; font-size: 3rem;" ></i></h1>
							</div>
						</div>

					</div>

					<div class="bg-light-danger bg-gradient progress-bar-striped py-3 px-6 rounded-bottom-2">
						<div class="row align-items-center" >
							<div class="col-md-10">
									<span class="text-dark" style="font-weight: bold ">
										Cek piutang yang jatuh tempo
									</span>
							</div>
							<div class="col-md-2">
								<i class="bi bi-arrow-right-circle icon-check-piutang" onclick="showJatuhTempo()" style="font-size:2rem;" ></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">
			<div class="col">
				<div class="card bg-body bg-light bg-gradient">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
									<span class="text-success" data-category-id="<?= $totalUnpaid ?>">
										<?= $totalUnpaid ?>
									</span>

								</div>
								<div class="fw-bold text-gray-800">
									Unpaid </div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-box-arrow-left" style="color:orangered; font-size: 3rem;" ></i></h1>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="col">
				<div class="card bg-body bg-light bg-gradient">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
									<span class="text-success" data-category-id="<?= $totalPaid ?>">
										<?= $totalPaid ?>
									</span>

								</div>
								<div class="fw-bold text-gray-800">
									Paid </div>
							</div>

							<div class="col-md-6  d-flex justify-content-center align-items-center">
								<h1><i class="bi bi-box-arrow-in-right" style="color:orangered; font-size: 3rem;" ></i></h1>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>

	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">
		<h3>Log Kehadiran</h3>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<?php $this->load->view($view_log_attendance)?>
			</div>
		</div>
	</div>

	<!-- Modal datatables -->
	<div class="modal fade" id="jatuhTempoModal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Jatuh tempo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php $this->load->view($view_data);?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<a href="<?= base_url('admin/piutang/piutang_page?status_piutang=2')?>" class="btn btn-primary" >See All</a>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view($view_components);?>

	<script>
		const base_url = $('meta[name="base_url"]').attr('content');

		function showJatuhTempo(){

			$("#jatuhTempoModal").modal("show");
		}

	</script>

</main>
