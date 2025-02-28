
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<main>
	<h1>Holiday</h1>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Holiday
	</button>


	<?php $this->load->view($view_data)?>
	<?php $this->load->view($view_components)?>

	<!-- Modal  Holyday -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Holiday</h3>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('absence/holyday/add_holyday') ?>" enctype="multipart/form-data">


						<div class="mb-2 fw-bolder text-gray-900">
							<span>Kode Libur</span>
						</div>
						<div class="mb-4">
							<input type="text" id="code_holyday" name="code_holyday" class="form-control bg-transparent"/>
						</div>

						<div class="mb-2 fw-bolder text-gray-900">
							<span>Type</span>
						</div>
						<div class="mb-4">
							<select class="form-select" name="type_group" id="type_group">
								<option selected>- Pilih Type -</option>
								<option value="1">All Products</option>
								<option value="2">All Divisions</option>
								<option value="3">All Products & Divisions</option>
								<option value="4">Custom</option>
							</select>
						</div>


						<div id="select_product" class="row mb-4" style="display: none;">
							<div class="col-12 fw-bolder text-gray-900">
								<span>Product</span>
							</div>
							<div class="col-12">
								<select class="form-select w-100" name="id_product[]" id="id_product" multiple>
									<?php foreach($products as $product): ?>
										<option value="<?=$product['id_product'];?>"><?=$product['name_product'];?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div id="select_division" class="row mb-4" style="display: none;">
							<div class="col-12 fw-bolder text-gray-900">
								<span>Division</span>
							</div>
							<div class="col-12">
								<select class="form-select w-100" name="id_division[]" id="id_division" multiple>
									<?php foreach($divisions as $division): ?>
										<option value="<?=$division['id_division'];?>"><?=$division['name_division'];?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="mb-2 fw-bolder text-gray-900">
							<span>Type Holiday</span>
						</div>
						<div class="mb-4">
							<select class="form-select" name="type_day" id="type_holyday">
								<option selected>- Pilih Type -</option>
								<option value="1">Single Day</option>
								<option value="2">Multiple Day</option>
							</select>
						</div>

						<div class="mb-2 fw-bolder text-gray-900">
							<span>Mulai Hari Libur</span>
						</div>
						<div class="mb-4">
							<input type="date" id="start_day" value="<?= date("Y-m-d") ?>" name="start_day" class="form-control bg-transparent"/>
						</div>

						<div id="end_date" style="display: none;">
							<div class="mb-2 fw-bolder text-gray-900">
								<span>Selesai Hari Libur</span>
							</div>
							<div class="mb-4">
								<input type="date" id="end_day" name="end_day" class="form-control bg-transparent"/>
							</div>
							<div class="mb-2 fw-bolder text-gray-900">
								<span>Total Hari</span>
							</div>
							<div class="mb-4">
								<input type="text" id="total" name="total" class="form-control bg-transparent" readonly/>
							</div>
						</div>

						<div class="mb-2 fw-bolder text-gray-900">
							<span>Jenis Libur</span>
						</div>
						<div class="mb-4">
							<select class="form-select" name="status_day" >
								<option selected>- Pilih Type -</option>
								<option value="1">Libur Nasional</option>
								<option value="2">Hari Minggu</option>
							</select>
						</div>


						<div class="d-grid mb-4">
							<button type="submit" id="submit_product" class="btn btn-primary">
								<span class="indicator-label">Add Holiday</span>
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


		document.addEventListener('DOMContentLoaded', function () {
			const typeGroup = document.getElementById('type_group');
			const selectDivision = document.getElementById('select_division');
			const selectProduct = document.getElementById('select_product');
			const typeHolyday = document.getElementById('type_holyday');
			const endDate = document.getElementById('end_date');
			const totalHari = document.getElementById("total");
			const startDay = document.getElementById("start_day");
			const endDay = document.getElementById("end_day");

			typeGroup.addEventListener('change', function () {
				if (this.value === '1') {
					selectDivision.style.display = 'block';
					selectProduct.style.display = 'none';
				} else if (this.value === '2') {
					selectProduct.style.display = 'block';
					selectDivision.style.display = 'none';
				} else if (this.value === '3') {
					selectProduct.style.display = 'none';
					selectDivision.style.display = 'none';
				} else if (this.value === '4') {
					selectProduct.style.display = 'block';
					selectDivision.style.display = 'block';
				}
			});

			typeHolyday.addEventListener('change', function () {
				if (this.value === '1') {
					endDate.style.display = 'none';
				} else {
					endDate.style.display = 'block';
					totalHari.value = 1;
				}
			});

			endDay.addEventListener("input", function () {
				const start = new Date(startDay.value);
				const end = new Date(endDay.value);

				if(start && end && end >= start){
					const diffTime = end.getTime() - start.getTime();
					const diffDays = Math.ceil(diffTime / (1000 * 3600 * 24)) + 1;
					totalHari.value = diffDays;
				} else {
					totalHari.value = 0;
				}
			})
		});



		$(document).ready(function() {
			$('#id_product, #id_division').select2({
				placeholder: "Select options",
				width: '100%'
			});
		});



	</script>
</main>
