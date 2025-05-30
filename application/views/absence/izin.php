<?php
$status_izin = isset($_GET['status_izin']) ? $_GET['status_izin'] : 3;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<main>
	<h1>Data Izin</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">

		<h4>Summary</h4>
		<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">

			<div class="col">
				<div class="card bg-body ">
					<div class="card-body py-4 ">
						<div class="row">
							<div class="col-md-6">
								<div class="text-gray-900 fw-bolder fs-2">
											<span class="text-success" data-category-id="<?=$total_izin_this_month?>">
												<?=$total_izin_this_month?>
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
											<span class="text-success" data-category-id="<?=$total_izin?>">
												<?=$total_izin?>
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

	<ul class="nav nav-tabs mt-8 ms-5">
		<li class="nav-item">
			<a class="nav-link  <?= ($status_izin == 3) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('absence/data/dataizin/emp_data_izin_page?status_izin=3&is=3')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_izin == 1) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('absence/data/dataizin/emp_data_izin_page?status_izin=1&is=3')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_izin == 2) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('absence/data/dataizin/emp_data_izin_page?status_izin=2&is=3')?>">Approval</a>
		</li>
	</ul>

	<?php $this->load->view($view_data)?>
	<?php $this->load->view($view_components)?>

	<script>


	</script>
</main>
