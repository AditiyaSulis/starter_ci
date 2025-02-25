<?php
$status_overtime = isset($_GET['status_overtime']) ? $_GET['status_overtime'] : 3;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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
											<span class="text-success" data-category-id="<?= $this_month?>">
												<?= number_format($this_month, 0 , ',', '.') ?> Hours
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
											<span class="text-success" data-category-id="<?= $this_year?>">
												<?= number_format($this_year, 0 , ',', '.') ?> Hours
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

	<ul class="nav nav-tabs mt-8">
		<li class="nav-item">
			<a class="nav-link <?= ($status_overtime == 3) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('absence/overtime/su_overtime_page?status_overtime=3&is=1')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_overtime == 1) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('absence/overtime/su_overtime_page?status_overtime=1&is=1')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_overtime == 2) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('absence/overtime/su_overtime_page?status_overtime=2&is=1')?>">Approval</a>
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
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/overtime/su_add_batch_overtime') ?>" enctype="multipart/form-data">
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
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Karyawan</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_employee[]" id="id_employee" multiple>

							</select>
						</div>
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
						<div class="row">
							<div class="col-6 col-md-6">
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Mulai Lembur (Jam)</span>
								</div>
								<div class="fv-row mb-8">
									<input type="time" id="start_overtime" name="start" autocomplete="off" class="form-control bg-transparent" />
								</div>
							</div>
							<div class="col-6 col-md-6">
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Selesai Lembur (Jam)</span>
								</div>
								<div class="fv-row mb-8">
									<input type="time" id="end_overtime" name="end" autocomplete="off" class="form-control bg-transparent" />
								</div>
							</div>
						</div>


						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Total Jam</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="total_hours" name="time_spend" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Upah</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="upah" name="pay" class="form-control bg-transparent" />
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
		const base_url = $('meta[name="base_url"]').attr('content');
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
						diff += 24 * 60 * 60 * 1000;
					}

					const hours = diff / (1000 * 60 * 60);
					totalHours.value = hours.toFixed(2);
				} else {
					totalHours.value = '';
				}
			}

			startOvertime.addEventListener('change', calculateTotalHours);
			endOvertime.addEventListener('change', calculateTotalHours);
		});


		//option select employee
		$('#id_division').on('change', function() {
			const divisionId = $(this).val();
			const productId = $('#id_product').val();
			const employeeSelect = $('#id_employee');

			accID = 'id_employee';
			accVAL = '';

			console.log('idDivision : '+ divisionId);
			console.log('idProduct : '+ productId);
			employeeSelect.html('<option value="" selected disabled>-select employee-</option>');

			if (divisionId) {
				getEmployee(productId, divisionId);
			}
		});


		//division to employee
		function getEmployee(productId, divisionId) {
			console.log("Mengambil data employee untuk:", { productId, divisionId });

			$.ajax({
				url: base_url + 'absence/overtime/option_employee',
				type: 'POST',
				data: {
					id_product: productId,
					id_division: divisionId
				},
				dataType: 'json',
				success: function(response) {
					console.log("Response dari server:", response);

					const employeeSelect = $('#' + accID);
					employeeSelect.empty(); //
					// employeeSelect.append('<option value="" selected disabled>-select employee-</option>');

					if (response.status) {
						$.each(response.data, function(index, employee) {
							const selected = accVAL == employee.id_employee ? 'selected' : '';
							employeeSelect.append(
								`<option value="${employee.id_employee}" ${selected}> ${employee.name}</option>`
							);
						});
					} else {
						console.log('Gagal mengambil data employee.');
					}
				},
				error: function(xhr, status, error) {
					console.error('Error AJAX:', error, xhr.responseText);
				}
			});
		}

		$(document).ready(function() {
			$('#id_employee').select2({
				placeholder: "Select options",
				width: '100%'
			});
		});
	</script>
</main>
