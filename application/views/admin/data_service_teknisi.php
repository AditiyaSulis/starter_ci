<?php
$status_service_teknisi = isset($_GET['status_service_teknisi']) ? $_GET['status_service_teknisi'] : 3;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<main>
	<h1>Record Service Teknisi</h1>


	<div class=" mt-12" style="border: 2px; padding: 20px; border-radius: 10px; background-color: #f0f0f0;">

		<h4>Summary</h4>
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
			<a class="nav-link <?= ($status_service_teknisi == 3) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('admin/service_teknisi/su_service_teknisi_page?status_service_teknisi=3&is=1')?>">Pending</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_service_teknisi == 1) ? 'active text-info' : 'text-dark' ?>"
			   href="<?=base_url('admin/service_teknisi/su_service_teknisi_page?status_service_teknisi=1&is=1')?>">Disapproval</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  <?= ($status_service_teknisi == 2) ? 'active text-info' : ' text-dark' ?>"
			   href="<?=base_url('admin/service_teknisi/su_service_teknisi_page?status_service_teknisi=2&is=1')?>">Approval</a>
		</li>
	</ul>

	<button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
		<i class="bi bi-plus-circle"></i>
		Add Record
	</button>

	<?php $this->load->view($view_data);?>
	<?php $this->load->view($view_components);?>

	<!-- Modal  Record -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Technician Service Record</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('admin/service_teknisi/su_add_service_teknisi') ?>" enctype="multipart/form-data">
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
							<span>Upah karyawan</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" id="total_service" name="total_service" autocomplete="off" class="form-control bg-transparent" />
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
										Add Record
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
		$(document).ready(function () {
			function loadEmployees(idProduct) {
				$.ajax({
					type: "POST",
					url: "<?= site_url('admin/service_teknisi/option_employee') ?>",
					data: { id_product: idProduct },
					dataType: "json",
					success: function (response) {
						var employeeSelect = $("#id_employee");
						employeeSelect.empty(); // Kosongkan opsi terlebih dahulu

						if (response.status && response.data.length > 0) {
							// Jika ada data, tambahkan ke dalam select
							employeeSelect.append('<option selected>-pilih karyawan-</option>');
							$.each(response.data, function (index, emp) {
								employeeSelect.append('<option value="' + emp.id_employee + '">' + emp.name + '</option>');
							});
						} else {
							// Jika tidak ada data, biarkan kosong (hanya opsi default)
							employeeSelect.append('<option selected>-tidak ada karyawan-</option>');
						}
					}
				});
			}

			// Panggil saat halaman pertama kali dimuat dengan seluruh karyawan
			loadEmployees("");

			// Saat produk dipilih
			$("#id_product").change(function () {
				var selectedProduct = $(this).val();
				if (selectedProduct === "-pilih product-") {
					selectedProduct = "";
				}
				loadEmployees(selectedProduct);
			});
		});
	</script>
</main>
