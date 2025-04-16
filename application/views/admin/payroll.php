

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<main>
	<h1>Payroll</h1>


	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Payroll
	</button>

	<ul class="nav nav-tabs mt-8 ms-5">
		<li class="nav-item">
			<a class="nav-link  <?= (isset($_GET['groupbycode'])) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('admin/payroll/payroll_page?groupbycode=1')?>">Group By Code</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= (!isset($_GET['groupbycode'])) ? 'active text-info' : 'text-dark border border-bottom-0 rounded-top bg-hover-light' ?>"
			   href="<?=base_url('admin/payroll/payroll_page')?>">Group By Id</a>
		</li>
	</ul>

	<?php $this->load->view($view_data); ?>
	<?php $this->load->view($view_components); ?>

	<!-- Modal  Payroll -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Payroll</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/payroll/add_batch_payroll') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Kode</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" name="code_payroll" value="PR<?=date('md')?><?=date('His')?><?=mt_rand(1,99)?>" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Input</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="input_at" autocomplete="off" class="form-control bg-transparent" />
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
							<select class="form-select overflow-auto" aria-label="Default select example" name="id_employee[]" id="id_employee" multiple>

							</select>
						</div>

						<div class="row">
							<div class="col-md-5 col-5">
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Mulai</span>
								</div>
								<div class="fv-row mb-8">
									<input type="date"  name="periode_gajian" autocomplete="off" class="form-control bg-transparent" />
								</div>
							</div>
							<div class="col-md-5 col-5">
								<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
									<span>Selesai</span>
								</div>
								<div class="fv-row mb-8">
									<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal_gajian" autocomplete="off" class="form-control bg-transparent" />
								</div>
							</div>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Bonus</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" name="bonus" value="0" autocomplete="off" class="form-control bg-transparent" oninput="formatRupiah(this)" />
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Uang makan</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_uang_makan" id="include_uang_makan">
								<option value="1">Yes</option>
								<option value="0" selected>No</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Insert Finance Record</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="finance_record" id="finance_record">
									<option value="1" selected>Auto Insert</option>
									<option value="2">Manual Insert</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Piutang</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="piutang" id="piutang">
								<option value="1" selected>Yes</option>
								<option value="2">No</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Potongan Telat</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_potongan_telat" id="include_potongan_telat">
								<option value="1" selected>Yes</option>
								<option value="2">No</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>BPJS</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_bpjs" id="include_bpjs">
								<option value="1">Yes</option>
								<option value="2" selected>No</option>
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>PPH</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="include_pph" id="include_pph">
								<option value="1">Yes</option>
								<option value="2" selected>No</option>
							</select>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Generate Payroll</span>
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

		function formatRupiah(input) {
			let value = input.value.replace(/[^0-9]/g, ""); // Hanya angka
			if (value === "") {
				input.value = "";
				return;
			}

			let formatted = new Intl.NumberFormat("id-ID").format(value);
			input.value = formatted;
		}

		// Menghapus titik sebelum form dikirim agar tidak error
		document.getElementById("addproduct").addEventListener("submit", function() {
			let input = document.querySelector("input[name='bonus']");
			if (input.value !== "") {
				input.value = input.value.replace(/\./g, ""); // Hapus semua titik sebelum submit
			}
		});

		$(document).ready(function() {
			$('#id_employee').select2({
				placeholder: "Select options",
				width: '100%'
			});
		});
	</script>
</main>
