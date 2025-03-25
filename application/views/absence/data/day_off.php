<?php
$status_day_off = isset($_GET['status_day_off']) ? $_GET['status_day_off'] : 3;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<main>
	<h1>Day Off</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">

		<h4>Day Off Summary</h4>
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

	<ul class="nav nav-tabs mt-8">
		<li class="nav-item">
			<a class="nav-link <?= ($status_day_off == 3) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('absence/dayoff/su_day_off_page?status_day_off=3&is=1')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_day_off == 1) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('absence/dayoff/su_day_off_page?status_day_off=1&is=1')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_day_off == 2) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('absence/dayoff/su_day_off_page?status_day_off=2&is=1')?>">Approval</a>
		</li>
	</ul>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Day Off
	</button>

	<?php $this->load->view($view_data);?>
	<?php $this->load->view($view_components);?>

	<!-- Modal  DayOff -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Day Off</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/DayOff/su_add_batch_day_off') ?>" enctype="multipart/form-data">
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
							<span>Tanggal Libur</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" id="tgl_day_off"  name="tgl_day_off" autocomplete="off" class="form-control bg-transparent" />
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
										Ajukan Libur
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
		const base_url = $('meta[name="base_url"]').attr('content');

		//FORM FIND EMPLOYEE
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
		})
		//END FORM EMPLOYEE

		//SET DATEPICKR
		document.addEventListener("DOMContentLoaded", function() {
			flatpickr("#tgl_day_off", {
				dateFormat: "Y-m-d",
				allowInput: true,
				mode: "multiple" // Bisa input manual
			});
		});
	</script>
</main>
