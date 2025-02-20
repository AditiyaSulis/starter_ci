
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<main>
	<h1>Payroll</h1>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Payroll
	</button>

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
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/payroll/su_add_batch_payroll') ?>" enctype="multipart/form-data">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Kode</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" name="code_payroll" autocomplete="off" class="form-control bg-transparent" />
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
							<select class="form-select" aria-label="Default select example" name="id_employee[]" id="id_employee" multiple>

							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Gajian</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="tanggal_gajian" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
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
