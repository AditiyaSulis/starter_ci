
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<main>
	<h1>Uang Makan</h1>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Batch
	</button>

	<?php $this->load->view($view_data); ?>
	<?php $this->load->view($view_components); ?>

	<!-- Modal  Payroll -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Uang makan</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/uang_makan/add_batch_uang_makan') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Kode</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" name="code_batch_uang_makan" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal_batch_uang_makan" autocomplete="off" class="form-control bg-transparent" />
						</div>
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

						<!--<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>--!>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Insert Finance Record</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="auto_finance_record" id="auto_finance_record">
								<option value="1" selected>Auto Insert</option>
								<option value="2">Manual Insert</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Potongan Libur nasional</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_holiday" id="include_holiday">
								<option value="1" selected>Yes</option>
								<option value="2">No</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Potongan Cuti</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_leave" id="include_leave">
								<option value="1" selected>Yes</option>
								<option value="2">No</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Potongan Absen</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_absen" id="include_absen">
								<option value="1" selected>Yes</option>
								<option value="2">No</option>
							</select>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Generate Batch Uang Makan</span>
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


		$(document).ready(function() {
			$('#id_employee').select2({
				placeholder: "Select options",
				width: '100%'
			});
		});
	</script>
</main>
testssssss
